<?php defined('CS__BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| home.php, Назначение: Логика отображения главной страницы блога
| Из файла /blog/blog.php
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

global $CS;

// отображать страницы в обратном порядке
$reverse    = TRUE;

// какие поля нужно выбрать
$needle     = [
    'cats', 'id', 'title',
    'short_text', 'link',
    'tag', 'author', 'views',
    'comments', 'date'
];

// получим пагинацию у текущего шаблона
$pagination = $CS->template->getPagination();

// выборка страниц
$result = cs_page::getListAll($pagination, $needle, TRUE);

// вывод xss ленты (если есть подходящий адрес)
if(function_exists('xss_feed_check') && xss_feed_check())
    die(xss_feed_display($result));

// соберем буфер
$buffer = $this->_displayPages($result, 'blog/short-page_view');

// и установим
$CS->template->setBuffer('body', $buffer, FALSE);

// и поставим мета данные
$CS->template->setMeta([
    'title' => "Home Page",
    'description' => "Welcome to our home page!"
]);