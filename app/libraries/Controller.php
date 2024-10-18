<?php
/**
 * Clase contrloador para gestionar lso modelos y las vistas
 */

 class Controller {

    //metodo para llamar al los modelos
    public function model($model)
    {
        if(file_exists('../app/models/' . $model . '.php'))
        {
            //requerir el archivo
            require_once ('../app/models/' . $model . '.php');

            return new $model();
        }
    }

    //metodo para servir las vistas
    public function view($view, $data = [])
    {
        //validar si el archivo existe
        if(file_exists('../app/views/' . $view . '.php'))
        {
            //requerimos el archivo
            require_once ('../app/views/' . $view . '.php');
        } else {
            die('el archivo no existe');
        }
    }

 }