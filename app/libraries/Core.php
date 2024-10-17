<?php
/**
 * Clase Core, gestionara las rutas para redireccioar a lso controladores
 */

 class Core {

    protected $controladorActual = 'Paginas';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct() {

        //validamos nuevamente
        $url = $this->getUrl();
        if(isset($url) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) 
        {
            $this->controladorActual = ucwords($url[0]);

            unset($url[0]);// se retira el indice 0
        }

        //requerimos el archivo
        require_once ('../app/controllers/' . $this->controladorActual . '.php');

        //instaciamos el controlador
        $this->controladorActual = new $this->controladorActual();

        // se valida si viene algun parametro
        if(isset($url[1]))
        {
            //se valida si el parametro existe en el cotnrolador
            if(method_exists($this->controladorActual, $url[1]))
            {
                $this->metodoActual = $url[1];
                unset($url[1]);// eliminamos el indice del metodo
            }
        }

        //revisamos si vienen parametros
        $this->parametros = isset($url) ? $url : null;

        //utilizamos una funcion de carga automatica de datos
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);


    }

    public function getUrl()
    {
        //gestionamos la url
        if(isset($_GET['url']))
        {
            $url = rtrim($_GET['url'], '/');// retiramos el ultimo caracter y los espacios
            $url = filter_var($url, FILTER_SANITIZE_URL);// limpiamos la cadena de url para evitar inyecciones
            $url = explode('/', $url); // convertimos la url en un arreglo

            return $url;
        } else {
            $url = ['Paginas'];

            return $url;
        }
    }
 }