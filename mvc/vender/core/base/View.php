<?php

namespace vender\core\base;

class View
{
    public $route = [];

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function render($vars)
    {
        if (is_array($vars)) extract($vars);
        $file_view = APP . "/views/{$this->route['controller']}/{$this->route['action']}.php";

        ob_start();
        if (is_file($file_view)):
            require_once $file_view;
        else:
            echo "<p>nema<b>$file_view</b></p> ";
        endif;
        $contend = ob_get_clean();

        $file_layout = APP . "/views/layouts/defolt.php";
        if (is_file($file_layout)):
            require_once $file_layout;
        else:
            echo "<p>nema<b>$file_layout</b></p> ";
        endif;
    }
}
?>