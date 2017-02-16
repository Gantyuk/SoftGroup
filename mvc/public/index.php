<?php

error_reporting(-1);

use vender\core\Router;

$qveri = rtrim($_SERVER['QUERY_STRING'], '/');

define("APP", dirname(__DIR__) . '/app');
define("ROOT", dirname(__DIR__));


spl_autoload_register(function ($class) {
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($file)):
        require_once $file;
    endif;
});

Router::add('^$', ['controller' => 'Main', 'actoin' => 'index']);
Router::add('^(?<controller>[a-z-]+)/?(?<action>[a-z-]+)?$');

Router::dispatch($qveri);
?>