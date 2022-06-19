<?php
namespace Scern\Lira\Data;

use Scern\Lira\Traits;

class Cookie
{
    use Traits\Getter,Traits\Singleton;

    private array $values;

    public function setCookie($key,$value,$expired,$path='/',$domain='',$secure=false)
    {
        setcookie($key,$value,$expired,$path,$domain,$secure);
        $this->values[$key] = $value;
    }
    private function __construct()
    {
        $this->values = $_COOKIE;
    }
}