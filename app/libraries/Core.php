<?php

/**
 * clase Core que gestiona las rutas para llamar a los controladores
 * sanear las URL
 */

 class Core {

    protected $controladorActual = 'Paginas';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct(){

        $url = $this->getUrl();
        
        //verificar el controlador
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php'))
        {
            $this->controladorActual = ucwords($url[0]);
            //requerir el controlador
            require_once ('../app/controllers/' . $this->controladorActual . '.php');
            //instanciar el controlador
            $this->controladorActual = new $this->controladorActual();

            //eliminar el indice 0 de array url
            unset($url[0]);

        }

        //validar el metodo
        if(isset($url[1]))
        {
            //validar el metodo
            if(method_exists($this->controladorActual, $url[1]))
            {
                //asignar al parametro
                $this->metodoActual = $url[1];
                //borrar la posision 1 del arreglo
                unset($url[1]);
            }
        }

        //validar si hay parametros
        $this->parametros = isset($url) ? array_values($url) : [];// operador ternario
        
        //llacamda automatica de controlador
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
    }


    public function getUrl()
    {
        if(isset($_GET['url']))
        {
            //recolectar la URL
            $url = rtrim($_GET['url'],'/');//eliminar espacios al final de la cadena
            $url = filter_var($url, FILTER_SANITIZE_URL); // sanitizar la url
            $url = explode('/', $url); //convertir la deba en un arreglo, partiendo de /

            return $url;
        } else {

            $url[0] = 'Paginas';

            return $url;
        }
    }
 }