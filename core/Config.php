<?php
namespace Scern\Lira;
defined('_DEXEC') or DIE;

use Scern\Lira\Traits;

class Config
{
    use Traits\Getter, Traits\Singleton;

    private static $instance;
    private array $headers;
    private array $values;

    private function __construct()
    {
        require_once('..'.DS.'config'.DS.'conf.php');
        $this->values = $config;
    }
}