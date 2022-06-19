<?php
namespace Scern\Lira\Data;

use Scern\Lira\Traits;

class Session
{
    use Traits\Getter,Traits\Setter,Traits\Singleton;

    private $ssid;
    private array $values;

    public function getSSID()
    {
        return $this->ssid;
    }

    public function destroy()
    {
        session_regenerate_id(TRUE);
        $_SESSION = [];
        session_destroy();
    }

    private function __construct()
    {
        session_start();
        $this->ssid = session_id();
        $this->values = $_SESSION;
    }
}