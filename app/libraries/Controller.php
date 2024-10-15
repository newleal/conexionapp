<?php

/** 
 * Controlador base que gestionara las vistas y los modelos de la aplicacion
*/
class Controller {

    public function model($model)
    {
        //validar si el modelo existente
        if(file_exists('../app/models/' . $model . '.php'))
        {
            //requerir el archivo
            require_once ('../app/models/' . $model . '.php');
            
            return new $model;
        }
    
    }

    public function view($view, $data = [])
    {
        //validar si la vista existe
        if(file_exists('../app/views/' . $view . '.php'))
        {
            //requerir el archivo
            require_once ('../app/views/' . $view . '.php');
        } else {
            die('La vista no existe');
        }
    }


}
