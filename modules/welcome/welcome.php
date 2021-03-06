<?php defined('CS__BASEPATH') OR exit('No direct script access allowed');
/**
 *
 *    CubSystem Minimal
 *      -> http://github.com/Anchovys/cubsystem/minimal
 *    copy, © 2020, Anchovy
 * /
 */

class module_welcome extends CsModule
{
    public function onLoad()
    {
        $CS = Cubsystem::getInstance();
        $CS->hooks->register('system_print_tmpl', function ()
        {
            $CS = Cubsystem::getInstance();
            $template = $CS->template;
            $template->setMeta('title', 'Hello! Welcome to CubSystem!');
            $template->setMeta('css', 'bootstrap.min.css');
            $template->setMeta('js', 'bootstrap.min.js');

            $mainTmpl = $template->getTmpl(1);
            $mainTmpl->set('title', 'Welcome to');
            $mainTmpl->set('subtitle', 'CubSystem minimal');
        });

        return parent::onLoad();
    }
}