<?php defined('CS__BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| blog.php [rev 1.4], Назначение: поддержка статей (блога)
| -------------------------------------------------------------------------
| В этом файле описана базовая функциональность для блога
| работа со статьями, базой данных
|
|
@
@   Cubsystem CMS, (с) 2020
@   Author: Anchovy
@   GitHub: //github.com/Anchovys/cubsystem
@
*/

class blog_module extends cs_module
{
    function __construct()
    {
        global $CS;
        $this->name = "Blog";
        $this->description = "A simple blog realization.";
        $this->version = "4";
        $this->fullpath = CS_MODULESCPATH . 'blog' . _DS;

        require_once($this->fullpath . 'xss_feed.php');

        require_once($this->fullpath . 'objects' . _DS . 'category.php');
        require_once($this->fullpath . 'objects' . _DS . 'page.php');

        if($h = $CS->gc('hooks_helper', 'helpers'))
        {
            // make hook into render
            $h->register('cs__pre-template_hook', 'view', $this);

            // admin hooks
            $h->register('cs__admin-view', 'admin_view',  $this);
            $h->register('cs__admin-ajax', 'admin_ajax',  $this);
        }
    }

    public function admin_view()
    {
        global $CS;
        $segments = cs_get_segment();

        if(!isset($segments[1]))
            return;

        if($segments[1] === 'page_edit')
        {
            $page = NULL;
            if(isset($segments[2]))
            {
                $id = $segments[2];
                $page = cs_page::getById(cs_filter($id, 'base;int'));
                $page = ($page === NULL || $page['count'] === 0) ? NULL : $page['result'];
            }

            $CS->template->callbackLoad(['page'=>$page], 'blog/page_edit_view', 'body');
        }
        if($segments[1] === 'page_list')
            $CS->template->callbackLoad('', 'blog/page_list_view', 'body');
        else if($segments[1] === 'addcat')
            $CS->template->callbackLoad('', 'blog/addcat_view', 'body');
    }

    public function admin_ajax()
    {
        require_once ($this->fullpath . 'blog_ajax.php');
        __ajax();

    }

    public function view()
    {
        $segment = cs_get_segment(0);
        $segment = $segment ? $segment : 'home';

        if($segment === 'home' || xss_feed_check())
            require_once ($this->fullpath . 'view' . _DS . 'home.php');
        elseif ($segment === 'category')
            require_once ($this->fullpath . 'view' . _DS . 'category.php');
        elseif ($segment === 'tag')
            require_once ($this->fullpath . 'view' . _DS . 'tag.php');
        elseif ($segment === 'page')
            require_once ($this->fullpath . 'view' . _DS . 'page.php');
    }

    protected function _displayPages($pages, $view_name = 'blog/short-page_view')
    {
        global $CS;
        $content = '';

        if(!isset($pages['count']) || $pages['count'] === 0)
        {
            return false;
        }
        elseif($pages['count'] > 1)
        {
            $total_pages = $pages['result'];

            foreach($total_pages as $page)
            {
                $content .= $CS->template->callbackLoad(['page' => $page], $view_name);
            }

            if($p = $CS->template->getPagination())
                $CS->template->setBuffer('pagination', $p->getHtml());

        }
        elseif ($pages['count'] == 1)
        {
            $page = $pages['result'];

            if(is_array($page))
                $page = $page[array_key_first($page)];

            $content = $CS->template->callbackLoad(['page' => $page], $view_name);
        }

        return $content;
    }
}