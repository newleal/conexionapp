<?php
/**
 * Clase Controlloer que getiona los modelos y vistas a utilizar en cada controlador
 */

 class Controller {

    public function model($model)
    {
        //verificar si existe el modelo
        if(file_exists('../app/models/'.$model.'.php'))
        {
            //requerir el archivo
            require_once ('../app/models/'.$model.'.php');

            return new $model();
        }
    }

    public function view($view, $data=[])
    {
        //veriricar si existe el archivo
        if(file_exists('../app/views/'.$view.'.php'))
        {
            //requerimos la vista
            require_once('../app/views/'.$view.'.php');

        } else {
            //la vista no existe
            die('La vista no existe');
        }
    }
 }