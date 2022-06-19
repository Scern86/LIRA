<?php
namespace Scern\Lira\Data;
defined('_DEXEC') or DIE;

class MemoryCache
{
    protected static $instance;
    protected $memcached;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new static();
        }
        return self::$instance->memcached;
    }
    private function __construct(){
        try {
            $this->memcached = new \Memcache;
            $this->memcached->addServer('localhost', 11211);
        } catch (\MemcachedException $e) {
            //print "Error!: " . $e->getMessage() . "<br />";
        }
    }
    private function __clone(){}
}