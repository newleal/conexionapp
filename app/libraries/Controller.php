<?php
/**
 * 
 * Controlaor base que carga modelos y vistas
 */

class Controller {

    //cargar el modelo
    public function model($model)
    {
        //requerir el modelo
        require_once ('../app/models/' . $model . '.php');

        return new $model();
    }

    // cargar las vista

    public function view($view, $data=[])
    {
        if(file_exists('../app/views/' . $view . '.php'))
        {
            //requierir el archivo
            require_once ('../app/views/' . $view . '.php');

        }else {
            die('La vista no existe');
        }
    }

}