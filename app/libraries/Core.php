<?php
/**
* Clase que gestionara las url
*/

class Core {

    protected $contradorActual = 'Paginas';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct() {
        //Cargamos automaticamente los datos de la url
        $url = $this->getUrl();
        

        //validar si existe la pagina
        if(isset($url) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) 
        {
            $this->contradorActual = ucwords($url[0]);
            unset($url[0]);//borramos el indice 0 que llama al controlador
        }

        //llamamos al archivo
        require_once ('../app/controllers/' . $this->contradorActual . '.php');

        //instanciamos el controlador
        $this->contradorActual = new $this->contradorActual();

        //validamos si el controlador tiene el metodo seleccionado
        if(isset($url[1]))
        {
            if(method_exists($this->contradorActual, $url[1]))
            {
                // Agregamos el metodo del controlador
                $this->metodoActual = $url[1];
                unset($url[1]);//Eliminamos el indice ref al metodo de la URL
            }
        }

        // Validamos si bienen parametros
        $parametros = isset($url) ? $url : null;

        //Lalamar de forma dinamica a los controladores que existan
        call_user_func_array([$this->contradorActual, $this->metodoActual], $this->parametros);


    }

    public function getUrl()
    {
       
        //validar si viene alg por la url
        if (isset($_GET['url']))
        {
            //limpiar la url
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);//lipiamos la url para que no vengan inyeccinoes URL
            $url = explode('/', $url);// orgaizamos un arreglo 

            return $url;
        } else {
            $url[0] = 'Paginas';
            return $url;
        }
    }

}
