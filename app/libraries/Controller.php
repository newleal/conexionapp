<?php

/**
 * Clase Controller que gestiona el modelo y las vistas en la aplicacion
 */

 class Controller {

    //revisar si existe el modelo
    public function model($model)
    {
        if(file_exists('../app/models/' . $model . '.php'))
        {
            //requerir el modelo
            require_once ('../app/models/' . $model . '.php');

            //retornar la instancia
            return new $model();
        }
    }

    //llamar a la vista
    public function view($view, $data=[])
    {
        //validar si existe la vista
        if(file_exists('../app/views/' . $view . '.php'))
        {
            //requerir el archivo
            require_once ('../app/views/' . $view . '.php');
            
        } else {

            //Si no existe la vista
            die('La vista no existe.');
        }
    }

 }