<?php
/**
 * Clase que gestiona las rutas de la URL
 */

 class Core {

    protected $controladorActual = 'Paginas';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct() {
        
        //Llamar los datos de la URL
        $url = $this->getUrl();

        //validar si existe el controlador
        if(isset($url))
        {
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php'))
            {
                //Se asigna al parametro
                $this->controladorActual = ucwords($url[0]);
            }

            //requerimos el archivo
            require_once ('../app/controllers/' . ucwords($url[0]) . '.php');

            //instanciamos a la clase del controlador
            $this->controladorActual = new $this->controladorActual();

            //limpiamos el arreglo
            unset($url[0]);
        } else {
            $this->controladorActual = 'Paginas';
        }

        //Validar si existe el indice del metodo
        if(isset($url[1]))
        {
            //validar si existe el metodo del controlador
            if(method_exists($this->controladorActual, $url[1]))
            {
                // Asignar al atributo el valor
                $this->metodoActual = $url[1];
    
                //Borrar el indice
                unset($url[1]);
            
            }
        }

        //revisar si vienen parametros por la url
        $this->parametros = isset($url)? array_values($url): null;

        //Cargar dinamicamente el controlador, metodos y parametros
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);

    }

    //recopilar lo datos de la URL
    public function getUrl()
    {
        if(isset($_GET['url']))
        {
            //recpilamos la data de la variable url
            $url = rtrim($_GET['url'], '/'); //limpiamos la variable con el ultimo simbolo /
            $url = filter_var($url, FILTER_SANITIZE_URL);// se limpia la url de caracteres
            $url = explode("/", $url);// se separa la variable url en un arreglo

            return $url;
        } else{
            $url[0] = 'Paginas';

            return $url;
        }
    }
 }
