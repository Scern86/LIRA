<?php
define('_DEXEC', 1);
define('DS',DIRECTORY_SEPARATOR);

include '../core/Application.php';

\Scern\Lira\Application::getInstance()
    ->route()
    ->execute()
    ->headers()
    ->render();