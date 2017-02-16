<?php

namespace vender\core\base;

abstract class Controller
{
    public $route = [];
    protected $vars = [];

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function getView()
    {
        $vObj = new View($this->route);
        $vObj->render($this->getVars());
    }

    public function setVars($vars)
    {
        $this->vars = $vars;
    }

    public function getVars()
    {
        return $this->vars;
    }
}
?>