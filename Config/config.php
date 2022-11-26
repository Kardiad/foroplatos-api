<?php

//Este lo que hace es tener las variables de entorno útiles.s

define('CONTROLLERS', ROOT_PATH.'/Controller');
define('MODELS', ROOT_PATH.'/Models');
define('PUBLIC', ROOT_PATH.'/Public');
define('VIEWS', ROOT_PATH.'/Views');
define('HELPERS', ROOT_PATH.'/Helpers');
define('HTTP', $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'foroplatos');

?>