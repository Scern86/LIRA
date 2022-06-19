<?php
namespace Scern\Lira\Components;

use Scern\Lira\Config;
use Scern\Lira\Interfaces\Controller;
use Scern\Lira\Render;
use Scern\Lira\Request;
use Scern\Lira\Router;
use Scern\Lira\Components\Admin as COM_ADMIM;

class Admin implements Controller
{
    public function execute()
    {
        $request = Request::getInstance();
        $request->get()->addUrlPartKey(1,'second');
        $router = new Router($request->get()->second);
        $router->default('Components\Admin\Login');
        $user = COM_ADMIM\User::getInstance();
        if($user->isLogged()) {
            $router->addRoute('ctrl','Components\Admin\Controller');
            Render::getInstance()->template = '..'.DS.'components'.DS.'Admin'.DS.'templates'.DS.'admin.phtml';
        }
        $router->execute();
    }
}