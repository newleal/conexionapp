<?php 
/**
 * Clase principal de la aplicacion
 * Crea URL y carga el controlador nucleo
 * Formateo de la URL /controlador/metodo/parametros
 */

 class Core {

    protected $controladorActual = 'Paginas';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct() {
        $url = $this->getUrl();
        //busca en los contrladores el primer valro del arreglo $url
        if($url && file_exists('../app/controllers/'.ucwords($url[0]).'.php'))
        {
            //si el archivo existe se establece ese controlador en la propiedad controladorActual
            $this->controladorActual = ucwords($url[0]);
            unset($url[0]);//elimino la variable con el indice 0
        }

        //requiriendo el controlador llamado de manera dinamica
        require_once ('../app/controllers/' . $this->controladorActual . '.php');

        //instanciando el controlador actual
        $this->controladorActual = new $this->controladorActual();

        //revisar la seguda parte de la URL
        if(isset($url[1]))
        {
            //revisar si el metodo existe
            if(method_exists($this->controladorActual,$url[1]))
            {
                //asignar al parametro
                $this->metodoActual = $url[1];
                //borrar el indice 1
                unset($url[1]);
            }
        }

        //obtener el resto de parametros
        $this->parametros = isset($url) ? array_values($url) : [];// operador ternario

        //Llamar un callback con  el array de parametros
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
    }

    public function getUrl()
    {
        if(isset($_GET['url']))
        {
            $url = rtrim($_GET['url'],'/');//limpiar los espacios y el / al final de al url
            $url = filter_var($url, FILTER_SANITIZE_URL);//sanitizamos la url de caracteres ilegales
            $url = explode("/",$url);//volvemos va la variable url en un arreglo separado por /

            return $url;
        } else {
            $url[0] = 'Paginas';
            return $url;
        }
    }
 }