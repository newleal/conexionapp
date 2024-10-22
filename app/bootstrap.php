<?php

//Cargar archivo de config
require_once ('helpers/sessionHelper.php');
require_once ('helpers/urlHelper.php');
require_once ('config/config.php');

//cargar archivos de librerias
// require_once ('../app/libraries/Core.php');
// require_once ('../app/libraries/Controller.php');
// require_once ('../app/libraries/Database.php');

//carga automatica de los archivos de libraries
spl_autoload_register(function($className){
    require_once ('libraries/' . $className. '.php');
});
