<?php
namespace Scern\Lira\Components\Admin\Models;

use Scern\Lira\Data\Db;

class Login extends Db
{
    protected $table = TBL_LOGIN;

    public function getLogin($ssid,$ip_address):bool
    {
        $sql = $this->db->prepare("SELECT id FROM {$this->table} WHERE DATE(created)=? AND ssid=? AND ip_address=? AND component=?");
        $sql->bindValue(1,date('Y-m-d'));
        $sql->bindValue(2,$ssid);
        $sql->bindValue(3,$ip_address);
        $sql->bindValue(4,'admin');
        $sql->execute();
        return !empty($sql->fetch(\PDO::FETCH_COLUMN)) ?? false;
    }

    public function saveLogin($ssid,$user_id,$ip_address,$user_agent):void
    {
        $sql = $this->db->prepare("INSERT INTO {$this->table} (created,ssid,user_id,ip_address,user_agent,component) VALUES (?,?,?,?,?,?)");
        $sql->bindValue(1,date('Y-m-d H:i:s'));
        $sql->bindValue(2,$ssid);
        $sql->bindValue(3,$user_id);
        $sql->bindValue(4,$ip_address);
        $sql->bindValue(5,$user_agent);
        $sql->bindValue(6,'admin');
        $sql->execute();
    }
}