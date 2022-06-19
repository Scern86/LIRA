<?php
namespace Scern\Lira;

defined('_DEXEC') or DIE;

class Request
{
    use Traits\Singleton;

    private $get;
    private $post;
    private $host;

    public function get()
    {
        return $this->get;
    }
    public function post()
    {
        return $this->post;
    }
    private function __construct()
    {
        $this->get = new Data\Get();
        $this->post = new Data\Post();
        $this->host = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
    }
}