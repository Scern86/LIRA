<?php
namespace Scern\Lira\Data;

use Scern\Lira\Traits;

class Post
{
    use Traits\Getter,Traits\Setter;

    private array $values;      // Массив $_POST

    public function __construct()
    {
        $this->values = $_POST;
    }
}