<?php

//archivo de configuracion
require_once ('config/config.php');

//carga de archivos helpers
require_once ('helpers/urlHelper.php');
require_once ('helpers/sessionHelper.php');

// require_once ('libraries/Core.php');
// require_once ('libraries/Controller.php');
// require_once ('libraries/Database.php');

spl_autoload_register(function ($className){
    require_once ('libraries/' . $className . '.php');
});