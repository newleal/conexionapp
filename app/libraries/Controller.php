<?php
/**
 * Clase Controller que gestiona las vistas y la conexion con los modelos
 */

 class Controller {

    //validar controlador
    public function model($model)
    {
        //validar si existe el archivo
        if(file_exists('../app/models/' . $model . '.php'))
        {
            //echo file_exists('../app/models/' . $model . '.php');
            //requerir el archivo
            require_once ('../app/models/' . $model . '.php');
            
            //devolver la instancia
            return new $model();
        } else {
            die('No existe el archivo');
        } 
    }

    //validar la vista
    public function view($view, $data = [])
    {
        //validar si existe el archivo
        if(file_exists('../app/views/' . $view . '.php'))
        {
            //requerir el archivo
            require_once ('../app/views/' . $view . '.php');

        } else {
            die('No existe la pagina');
        }
    }

 }