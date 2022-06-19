<?php
namespace Scern\Lira\Controllers;

use Scern\Lira\Application;
use Scern\Lira\Config;
use Scern\Lira\Interfaces\Controller;
use Scern\Lira\Render;
use Scern\Lira\Request;

class Obj implements Controller
{
    public function execute()
    {
        $render = Render::getInstance();
        $render->title = strtoupper(Request::getInstance()->get()->controller);
        $render->lang = 'obj';
    }
}