<?php
namespace Scern\Lira\Controllers;

use Scern\Lira\Application;
use Scern\Lira\Config;
use Scern\Lira\Interfaces\Controller;
use Scern\Lira\Render;
use Scern\Lira\Request;

class Test implements Controller
{
    public function execute()
    {
        $render = Render::getInstance();
        //$render->title = '404 Not found';
        //$render->lang = 'tst';
        if(Request::getInstance()->get()->ajax==1){
            $render->showOnlyContent()->content = json_encode([1=>'test',2=>'Что-то новое',3,4]);
        }
        //$render->content = '<h1>ERROR 404</h1>';
        //http_response_code(404);
    }
}