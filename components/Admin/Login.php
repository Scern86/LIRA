<?php
namespace Scern\Lira\Components\Admin;

use Scern\Lira\Config;
use Scern\Lira\Interfaces\Controller AS IFController;
use Scern\Lira\Render;
use Scern\Lira\Request;
use Scern\Lira\Components\Admin\User;

class Login implements IFController
{
    public function execute()
    {
        $template_path = '..'.DS.'components'.DS.'Admin'.DS.'templates';
        $render = Render::getInstance();
        $request = Request::getInstance();
        $user = User::getInstance();

        if($user->isLogged()) $render->template = $template_path.DS.'admin.phtml';

        switch($request->get()->second){
            case 'login':
                if($user->isLogged()) $render->setHeader('Location: /admin');
                else{
                    if($request->post()->login){
                        if($user->login($request->post()->login,$request->post()->password)) $render->showOnlyContent()->content = json_encode(['success'=>true,'link'=>'/admin']);
                        else $render->showOnlyContent()->content = json_encode(['success'=>false]);
                    }
                    else $render->template =  $template_path.DS.'admin-login.phtml';
                }
                break;
            case 'logout':
                if($user->isLogged()) {
                    $user->logout();
                    $render->setHeader('Location: /admin/login');
                }
                break;
            default:
                if(!$user->isLogged()) $render->setHeader('Location: /admin/login');
                break;
        }
    }
}