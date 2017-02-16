<?php

namespace vender\core;

class Router
{
    protected static $routes = [];
    protected static $route = [];

    public static function add($regexp, $router = [])
    {
        self::$routes[$regexp] = $router;
    }

    public static function matchRoute($url)
    {
        foreach (self::$routes as $patern => $route):
            if (preg_match("#$patern#i", $url, $matches)):
                foreach ($matches as $key => $value):
                    if (is_string($key)):
                        $route[$key] = $value;
                    endif;
                endforeach;
                if (!isset($route['action'])):
                    $route['action'] = 'index';
                endif;
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            endif;
        endforeach;
        return false;
    }

    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)):
            $controller = 'app\controllers\\' . self::$route['controller'] . "Controller";
            if (class_exists($controller)):
                $cObj = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']);
                if (method_exists($cObj, $action)):
                    $cObj->$action();
                else:
                    require_once APP."/views/layouts/ERROR.php";
                endif;
            else:
                require_once APP."/views/layouts/ERROR.php";
            endif;
        else:
            require_once APP."/views/layouts/ERROR.php";
        endif;
    }

    protected static function upperCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    protected static function lowerCamelCase($name)
    {
        return lcfirst(self::upperCamelCase($name));
    }

    protected static function removeQueryString($url)
    {
        if ($url):
            $params = explode('&', $url, 2);
            if (false === strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            } else return '';
        endif;
    }
}

?>