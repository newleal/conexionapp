<?php
/**
 * clase que gestiona el manejo de las rutas url que ingresan al sistema
 */

 class Core {

    protected $controladorActual = 'index';
    protected $metodoActual = 'Paginas';
    protected $parametros = [];

    public function __construct(){

        $url = $this->getUrl();
        if(isset($url))
    }

    public function getUrl()
    {
        if(isset($_GET['url']))
        {
            //limpiar la url
            $url = rtrim($_GET['url'],'/'); // limpiar el ultimo simbolo / de la cadena
            $url = filter_var($url, FILTER_SANITIZE_URL);//limpieza de caracteres especiales
            $url = explode('/', $url);// convertir la url en un arreglo
        
            return $url;
        } else {

            //en caso de que no exista nada por la url
            $url[0] = 'Paginas';
            return $url;
        } 

        
        
    }
 }
