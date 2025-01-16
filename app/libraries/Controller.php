<?php
/**
 * Clase pader Controller la cual va a gestionar lo modelos y las vistas para cada controlador
 */

 class Controller {

    //gestion de modelos
    public function model($model)
    {
        //verificar si el modelo existe
        if(file_exists('../app/models/' . $model . '.php'))
        {
            //requerir el modelo
            require_once ('../app/models/' . $model . '.php');
            //enviar la instancia
            return new $model();
        }
    }

    //gestion de vistas
    public function view($view, $data = [])
    {
        //verificar si la vista existe
        if(file_exists('../app/views/' . $view . '.php'))
        {
            //requerir la vista
            require_once ('../app/views/' . $view . '.php');

        } else {
            die('La vista no existe');
        }
    }
    

        
    
 }