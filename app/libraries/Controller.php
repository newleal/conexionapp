<?php

//clase padre de Controller
class Controller {

    //metodo que gestiona los modelos
    public function model($model)
    {
        //ferificar si el archivo existe
        if(file_exists('../app/models/' . $model . '.php'))
        {
            //requerir el archivo
            require_once('../app/models/' . $model . '.php');
            //instanciar el modelo
            return new $model;
        }
    }

    //metodo que gestiona las vistas
    public function view($view, $data = [])
    {
        //verificar si la vista existe
        if(file_exists('../app/views/' . $view . '.php'))
        {
            //se requiere la vista
            require_once('../app/views/' . $view . '.php');
        }else{
            die('La vista no existe');
        }
    }
}