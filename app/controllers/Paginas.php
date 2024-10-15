<?php

/**
 * Cargamos el controaldor generico llamapd Paginas
 */

class Paginas extends Controller{

    public function __construct(){
        //echo 'Hola mundo desde controlador Paginas';
    }

    public function index()
    {
        $this->view('paginas/index', ['titulo' => 'Bienvenidos']);
    }

    public function about()
    {
        $this->view('paginas/about');
    }
} 