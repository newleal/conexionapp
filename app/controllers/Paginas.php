<?php

/**
 * Clase paginas
 * carga la vistea del usuaro loggeado
 */

 class Paginas{

    public function __construct(){

        echo 'Hola desde construct de Paginas';
    }

    public function index()
    {
        echo 'Metodo index del controlador Paginas';
    }

    public function about()
    {
        echo 'Metodo about del controlador Paginas';
    }
 }