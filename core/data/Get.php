<?php
namespace Scern\Lira\Data;
//defined('_DEXEC') or DIE;

use Scern\Lira\Traits;

class Get
{
    use Traits\Getter,Traits\Setter;
    private string $raw_url;    // Полный REQUEST, без обработки
    private array $url_parts = [];   // Массив значений, полученных с ЧПУ
    private array $values = [];      // Массив $_GET

    public function addUrlPartKey($order,$key):object
    {
        if(array_key_exists($order,$this->url_parts) AND !array_key_exists($key,$this->values)) $this->values[$key] = $this->url_parts[$order];
        return $this;
    }

    public function __construct()
    {
        $this->raw_url = $_SERVER['REQUEST_URI'];
        $this->values = $_GET;
        if($this->q) $this->url_parts = array_filter(explode('/',$this->q));
    }
}