<?php
/**
 * Clase core que gestiona las rutas de lso contrladores
 */

 class Core {

    protected $controladorActual = 'Paginas';
    protected $metodoActual = 'index';
    protected $parametros = [];


    public function __construct() {
        
        $url = $this->getUri();
        
        //validar el controlador existe
        if(isset($url) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) 
        {
            $this->controladorActual = ucwords($url[0]);

            //borramos el indice del controlador
            unset($url[0]);
        }
        

        //requerimos el controlador
        require_once ('../app/controllers/' . $this->controladorActual . '.php');

        //instanciamos la clase
        $this->controladorActual = new $this->controladorActual();

        //valdiar si existe el metodo de la instancia
        if(isset($url[1]))
        {
            if(method_exists($this->controladorActual, $url[1]))
            {
                $this->metodoActual = $url[1];
                unset($url[1]);// Borramos el indice del metodo
            }
        }

        //Validamos los parametros
        $this->parametros = isset($url) ? array_values($url) : null;

        //funcion de carga automaticamente al controlador solcitado
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
    }

    public function getUri()
    {
        //organizar url y particionarla
        
        if(isset($_GET['url']))
        {
            $url = rtrim($_GET['url'], '/');// limpiar la url del ultimo espacio y el ultimo /
            $url = filter_var($url, FILTER_SANITIZE_URL);//sanitizar la url para evitar inyeccion de codigo
            $url = explode('/', $url);//organizar la variable para separa la url en un arreglo

            return $url;
        } else {

            $url[0] = 'Paginas';
            return $url;
        }
    } 

 }