<?php
namespace Scern\Lira;
defined('_DEXEC') or DIE;

use Scern\Lira\Traits;

class Render
{
    use Traits\Getter,Traits\Setter,Traits\Singleton;
    private array $headers;
    private array $values;
    private bool $show_only_content = false;
    private $order=null; // Временная переменная для хранения порядка блоков в позиции шаблона

    public $template;

    public static function partial($template,$data)
    {
        ob_start();
        include($template);
        $result = ob_get_contents();
        ob_get_clean();
        return $result;
    }

    public function setHeader($header)
    {
        $this->headers[] = $header;
        return $this;
    }
    public function renderHeaders()
    {
        if(!empty($this->headers)) foreach($this->headers as $item){
            header($item);
        }
    }

    // Render->order(2)->left = HTML
    public function order($order)
    {
        $this->order = $order;
        return $this;
    }
    public function __set($key,$value)
    {
        if(!is_null($this->order)){
            if(array_key_exists($key,$this->values) AND is_array($this->values[$key])) $this->values[$key][$this->order] = $value;
            else $this->values[$key] = [$this->order=>$value];
            $this->order = null;
        }
        else $this->values[$key] = $value;
    }

    // Показывать только Render->content, скрывать main_template
    public function showOnlyContent()
    {
        $this->show_only_content = true;
        return $this;
    }
    public function renderFull()
    {
        if($this->show_only_content) $result = $this->values['content'];
        else $result = self::partial($this->template,$this);
        return $result;
    }
}