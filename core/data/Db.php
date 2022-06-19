<?php
namespace Scern\Lira\Data;
use Scern\Lira\Traits;
use Scern\Lira\Config;

//defined('_DEXEC') or DIE;

class Db{
    use Traits\Singleton;
    protected $db;

    private function __construct(){
        $config_db = Config::getInstance()->db;
        try {
            $dsn = 'pgsql:host='.$config_db['host'].';port='.$config_db['port'].';dbname='.$config_db['dbname'];
            $this->db = new \PDO($dsn, $config_db['username'], $config_db['password']);
        } catch (\PDOException $e) {
            //print "Error!: " . $e->getMessage() . "<br />";
        }
    }
    public function getDBO()
    {
        return $this->db;
    }
}