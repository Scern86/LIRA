<?php
namespace Scern\Lira\Components\Admin;

use Scern\Lira\Config;
use Scern\Lira\Data\Db;
use Scern\Lira\Interfaces\Controller AS IFController;
use Scern\Lira\Render;
use Scern\Lira\Request;

class Controller implements IFController
{
    public function execute()
    {
        echo 'Admin controller';
    }
}