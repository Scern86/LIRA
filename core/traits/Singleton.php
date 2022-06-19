<?php
namespace Scern\Lira\Traits;

trait Singleton
{
    private static $instance;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new static();
        }
        return self::$instance;
    }
    private function __construct(){}
    private function __clone(){}
}