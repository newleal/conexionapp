<?php

/**
 * Clase controlador para gestrionar los modelos y vistas
*/

class Controller {

    //gestionar llamada de modelos
    //validar si existe el modelo 
    public function model($model)
    {
        if(file_exists('../app/models/' . $model . '.php'))
        {
            //requerimos el archivo
            require_once ('../app/models/' . $model . '.php');

            //retornamos la instancia
            return new $model();
        }
    }

    //gestionar las vistas
    public function views($view, $data=[])
    {
        
        //validar si el archivo de la vista existe
        if(file_exists('../app/views/' . $view . '.php'))
        {
           //requerimos la vista
           require_once ('../app/views/' . $view . '.php'); 
        
        } else {
            die('el archivo no existe');
        }
    }

}