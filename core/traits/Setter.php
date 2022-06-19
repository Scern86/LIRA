<?php
namespace Scern\Lira\Traits;

trait Setter
{
    public function __set($key,$value)
    {
        $this->values[$key] = $value;
        return $this;
    }
    public function __unset($key)
    {
        if(array_key_exists($key,$this->values)) unset($this->values[$key]);
        return $this;
    }
}