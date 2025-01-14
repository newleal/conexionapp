<?php

//Carga de archivo de configuracion
require_once ("../app/config/config.php");

//Cargar librerias
// require_once ('libraries/Core.php');
// require_once ('libraries/Controller.php');
// require_once ('libraries/Database.php');

spl_autoload_register(function($className){
    require_once('libraries/' . $className . '.php');
});
