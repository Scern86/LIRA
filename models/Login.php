<?php
namespace Scern\Lira\Models;

use \Scern\Lira\Data\Db;

class Login extends Db
{
    public function getRecord($ssid,$ip_address)
    {
        var_dump($this->db);
    }
}