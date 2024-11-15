<?php

/**
 * Archivo de arranque de la poalicacion
 */

 require_once ('config/config.php');

//  require_once ('../app/libraries/Database.php');
//  require_once ('../app/libraries/Core.php');
//  require_once ('../app/libraries/Controller.php');

   spl_autoload_register(function($className){
      require_once ('../app/libraries/' . $className . '.php');
   });