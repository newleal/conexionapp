<?php
//Se cargsa archivo de configuracion
require_once ('../app/config/config.php');


//carga de helpers
require_once (APPROOT . '/helpers/urlHelper.php');
require_once (APPROOT . '/helpers/sessionHelper.php');

// //Se cargar los archivos de libraries
// require_once ('../app/libraries/Database.php');
// require_once ('../app/libraries/Core.php');
// require_once ('../app/libraries/Controller.php');

//funcion de carga automatica de controladores de libraires
spl_autoload_register(function($className){
    require_once ('libraries/' . $className . '.php');
});