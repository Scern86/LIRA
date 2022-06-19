<?php
namespace Scern\Lira\Traits;

trait Getter
{
    protected $default_value = null;

    public function __get($key):mixed
    {
        $result = false;
        if(array_key_exists($key,$this->values)) $result = $this->values[$key];
        else if(!empty($this->default_value)) {
            $result = $this->default_value;
            $this->default_value = null;
        }
        return $result;
    }
    public function default($default_value):object
    {
        $this->default_value = $default_value;
        return $this;
    }
}