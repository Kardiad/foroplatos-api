<?php

//Atrapa bots para securizar un poco el framework básico
$appPath = explode(DIRECTORY_SEPARATOR, __DIR__);
unset($appPath[count($appPath)-1]);
define('ROOT_PATH', implode('/', $appPath));
//_dump(ROOT_PATH);
require_once __DIR__.'/config.php';
require_once ROOT_PATH.'/Controller/Api/BaseControler.php';
require_once ROOT_PATH.'/Models/MainModel.php';

?>