<?php
namespace Scern\Lira\Components\Admin;

use Scern\Lira\Data;
use Scern\Lira\Traits;
use Scern\Lira\Components\Admin\Models\Login;

class User
{
    use Traits\Singleton;
    private $user = null;
    private $session;
    private $cookie;
    private bool $is_logged_in = false;

    public function isLogged():bool
    {
        return $this->is_logged_in;
    }

    public function login($login,$password):bool
    {
        $result = false;
        if($login=='test' AND $password=='test'){
            $this->cookie->setCookie('logged_in',1,time()+3600,'/admin');
            $this->is_logged_in = true;
            Login::getInstance()->saveLogin($this->session->getSSID(),111,$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']);
            $result = true;
        }
        return $result;
    }
    public function logout():void
    {
        $this->cookie->setCookie('logged_in',null,-1,'/admin');
        $this->session->destroy();
    }

    public function getUser()
    {
        return $this->user;
    }
    private function __construct()
    {
        $this->session = Data\Session::getInstance();
        $this->cookie = Data\Cookie::getInstance();
        $this->checkLogin();
    }
    private function checkLogin():void
    {
        if($this->cookie->logged_in AND Login::getInstance()->getLogin($this->session->getSSID(),$_SERVER['REMOTE_ADDR'])) {
            $this->is_logged_in = true;
            // Load THIS->user
        }
    }
}
