<?php

class Paginas {

    public function __construct() {

        //echo 'Paginas cargadas';
    }

    public function index()
    {
        echo 'index de Paginas';
    }

    public function about($id = '')
    {
        echo $id;
    }
}