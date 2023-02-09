<?php
namespace Tsel\Blog\core;
class View
{
    function render($tmp, $vars = array()) {
        if(file_exists( __DIR__ . '/../templates/'. $tmp . '.tpl.php')) {
            ob_start();
            extract($vars);
            require __DIR__ . '/../templates/' . $tmp . '.tpl.php';
            return ob_get_clean();
        }
    }
}