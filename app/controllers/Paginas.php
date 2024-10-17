<?php

/**
 * crear la clase Paginas
 */

 class Paginas{

    public function __construct() {

        echo 'Hola desde controller paginas';
    }

    public function index()
    {
        echo 'Index de Paginas';
    }

    public function about()
    {
        echo 'about de Paginas';
    }
 }