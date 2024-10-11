<?php

//conexion de archivo config
require_once ('config/config.php');

// require_once ('libraries/Core.php');
// require_once ('libraries/Controller.php');
// require_once ('libraries/Database.php');
//Recarga automatica de los archivos
spl_autoload_register(function($className){
    require_once ('libraries/' . $className . '.php');
});

$init = new Core();