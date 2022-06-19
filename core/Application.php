<?php

namespace Scern\Lira;
use Scern\Lira\Interfaces;
use Scern\Lira\Traits;

defined('_DEXEC') or DIE;
require_once('..'.DS.'vendor'.DS.'autoload.php');
require_once('..'.DS.'config'.DS.'tables.php');

class Application implements Interfaces\Controller
{
    use Traits\Singleton,Traits\Getter, Traits\Setter;
    private $config;
    private $router;
    private $render;
    private array $values = [];

    public function route():Application
    {
        $request = Request::getInstance();

        $request->get()->addUrlPartKey(0,'first');

        $url_part = $request->get()->first;

        $this->router = new Router($url_part);
        $this->router
            ->addRoute('admin','Components\Admin')
            ->addRoute('test','Controllers\Test')
            ->default('Controllers\Lang');

        return $this;
    }

    public function execute():Application
    {
        $this->router->execute();
        return $this;
    }

    public function headers():Application
    {
        $this->render->renderHeaders();
        return $this;
    }

    public function render():void
    {
        echo $this->render->renderFull();
    }

    private function __construct()
    {
        $this->config = Config::getInstance();
        $this->render = Render::getInstance();
        $this->render->title = 'Главная | SCERN';
        $this->render->template = '..'.DS.'templates'.DS.'main.phtml';
        $this->values['lang'] = $this->config->lang;
    }
}
