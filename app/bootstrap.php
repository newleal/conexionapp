<?php

//carga archivo de configuracion
require_once('../app/config/config.php');

//cargta de helpers
require_once ('helpers/urlHelper.php');
require_once ('helpers/sessionHelper.php');

//cargar bilbiotecas base
// require_once('libraries/Core.php');
// require_once('libraries/Controller.php');
// require_once('libraries/Database.php');

spl_autoload_register(function($className){
    require_once 'libraries/'. $className . '.php';
});
