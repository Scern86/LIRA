<?php
namespace Scern\Lira\Controllers;

use Scern\Lira\Application;
use Scern\Lira\Config;
use Scern\Lira\Interfaces\Controller;
use Scern\Lira\Render;
use Scern\Lira\Request;

class Lang implements Controller
{
    public function execute()
    {
        $lang = Request::getInstance()->get()->first;
        $config = Config::getInstance();
        if(!in_array($lang,$config->site_langs)) {
            $redirect = 'Location: /'.$config->lang;
            header($redirect);
            exit();
        }
        else{
            $request = Request::getInstance();
            $request->get()->addUrlPartKey(0,'lang');
            $request->get()->addUrlPartKey(1,'controller');
            Application::getInstance()->lang = $request->get()->lang;
            $url_part = $request->get()->controller;
            $router = new \Scern\Lira\Router($url_part);
            $router
                ->addRoute('article','Controllers\Obj')
                ->addRoute('news','Controllers\Obj')
                ->addRoute('catalog','Controllers\Obj')
                ->addRoute('gallery','Controllers\Obj')
                ->default('Controllers\Test');

            $router->execute();
        }
    }
}