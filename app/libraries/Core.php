<?php

//clase que gestiona las rutas de la aplicacion
class Core {

    private $controladorActual = 'Paginas';
    private $metodoActual = 'index';
    private $parametros = [];

    public function __construct()
    {
       var_dump( $this->getUrl());
       $url = $this->getUrl();

       // se busca si existe el controlador
       if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php'))
       {
            //se asigna el valor al atributo
            $this->controladorActual = ucwords($url[0]);
            unset($url[0]);
       }

       // se manda a llamar elcontrolador
       require_once('../app/controllers/' . $this->controladorActual . '.php');
       //se instancia la clase
       $this->controladorActual = new $this->controladorActual();

       //verificacion de metodos del controlador
       if(isset($url[1]) && method_exists($this->controladorActual, $url[1]))
       {
            //se agrega el valor al atributo
            $this->metodoActual = $url[1];
            unset($url[1]);
       }

       //enviar parametros al controlador
       $this->parametros = $url ? array_values($url): [];

       call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
    }

    public function getUrl()
    {
        if(isset($_GET['url']))
        {
            $url = rtrim($_GET['url'],'/');//limpiar el ultimo caracter / y espacios
            $url = filter_var($url, FILTER_SANITIZE_URL); //sesanitiuza ka url de posibles inyecciones SQL
            $url = explode('/',$url); // se convierte la variable de string a arreglo

            return $url;
        }else {
            $url[0] = 'Paginas';
            return $url;
        }
        
    }

}