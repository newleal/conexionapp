<?php

class Core {

    protected $controladorActual = 'Paginas';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct() {

        $url =  $this->getUrl();

       

        //validamo si existe algo por la url y si el archivo esiste en el core
        if(isset($url) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php'))
        {
            //Agregammos el controlador
            $this->controladorActual = ucwords($url[0]);
            unset($url[0]);//Eliminamos el indice 0
        } 

        // instanciamos el controlador
        require_once ('../app/controllers/' . $this->controladorActual . '.php');
        $this->controladorActual = new $this->controladorActual();

        //revisamos si exixte el metodo
        if(isset($url[1]))
        {
            //validamos si viene el metodo
            if(method_exists($this->controladorActual, $url[1]))
            {
                $this->metodoActual = $url[1];
                unset($url[1]); //borramos el indice 1
            }
        }

        //validamos si venen parametros por al url
        $this->parametros = $url ? array_values($url) : [null];
        

        //Llamamos a un metodo anonimo para ejecutar cotrolador-metodos y parametros
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);

    }


    public function getUrl()
    {
        //valida rsi vien algo por la variable url
        if(isset($_GET['url']))
        {
            //retirar la variable de simbolo / adiconales con rtrim
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);// limpiar la url de inyeccion SQL
            $url = explode("/", $url); // crear un arreglo de objetos dela URL separados por /

            return $url;
        } else {
            $url[0] = 'Paginas';
            return $url; 
        }
        
    }
}