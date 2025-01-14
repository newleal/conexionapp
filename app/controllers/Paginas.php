<?php

class Paginas extends Controller{

    public function __construct() {

        //echo 'Paginas cargadas';
    }

    public function index()
    {
        $this->view('paginas/index', ['titulo' => 'Bienvenido']);
    }

    public function about()
    {
        $this->view('paginas/about');
    }
}