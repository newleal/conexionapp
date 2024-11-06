<?php

/**
 * Clase Core que maneja url
 */

class Core {

    protected $controladorActual = 'Paginas';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct() {

        //obtener la url array
        $url = $this->getUrl();

        //valdiar si viene datos por la url y si hay controlador
        if(isset($url) && file_exists( '../app/controllers/' . ucwords($url[0])) . '.php')
        {
            //validar el controlador actual
            $this->controladorActual = ucwords($url[0]);
            
            //llamar/requerir al controlador
            require_once ('../app/controllers/' . $this->controladorActual . '.php');
            //instanciar la clase
            $this->controladorActual = new $this->controladorActual();
            
            unset($url[0]);// borrar el indice 1 de la url que trae el controlador
            
        } else {
            $this->controladorActual = 'Paginas';
        }

        //validar si viene metodo del controlador
        if(isset($url[1])  )
        {   
            if(method_exists($this->controladorActual, $url[1]))
            {

                //agregar el metodo
                $this->metodoActual = $url[1];
                
                unset($url[1]);// borrar el indice 2 que llama al metodo
            }
        }

        //validamos si vienen parametros por al url
        $this->parametros = isset($url) ? array_values($url) : null;
        
        //Llamado automatico del controladores y metodos
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);

    }

    public function getUrl()
    {
        //validar si vienen datos por la url
        if(isset($_GET['url']))
        {
            //limpiar la URL
            $url = rtrim($_GET['url'], '/');// limpiar el ultimo /
            $url = filter_var($url, FILTER_SANITIZE_URL);//limpiar sanitizar el string de url
            $url = explode("/", $url); //separar la url en un arreglo basado en el /

            return $url;

        } else {

            $url[] = 'Paginas'; 

            return $url;
        }
        
    }
    
}