<?php
namespace Scern\Lira;

use Scern\Lira\Interfaces\Controller;

class Router implements Controller
{
    private string $url_part = '';
    private $controller = null;
    private $default_controller = null;

    public function addRoute($url_part,$class)
    {
        $class = 'Scern\Lira\\'.$class;
        if(class_exists($class) AND $this->url_part==$url_part) $this->controller = $class;
        return $this;
    }
    public function default($class)
    {
        $class = 'Scern\Lira\\'.$class;
        if(class_exists($class)) $this->default_controller = $class;
        return $this;
    }

    public function access(){}

    public function execute()
    {
        $controller_name = $this->controller ?? $this->default_controller;
        $controller = new $controller_name();
        if($controller instanceof Controller) $controller->execute();
    }

    public function __construct($url_part)
    {
        $this->url_part = $url_part;
    }
}