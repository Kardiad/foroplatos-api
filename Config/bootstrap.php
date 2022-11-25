<?php

//Atrapa bots para securizar un poco el framework básico
$appPath = explode('\\', __DIR__);
unset($appPath[count($appPath)-1]);
//var_dump($appPath);
define('ROOT_PATH', implode('/', $appPath));
require_once __DIR__.'/config.php';
require_once ROOT_PATH.'/Controller/Api/BaseControler.php';
require_once ROOT_PATH.'/Models/MainModel.php';

?>