<?php

/**
 * Clase de controlador Paginas
 */

 class Paginas extends Controller{

    private $posts;

    public function __construct() {
        //instaciamos al modelo
        $this->posts = $this->model('Post');
    }

    public function index()
    {
        //Validacion de sesion
        if(isLoggedIn())
        {
            redirect('posts');
        }

        //traemos la consulta
        

        $data = ['titulo' => 'Bievenidos.'];

        $this->views('paginas/index', $data);
    }

    public function about()
    {
        $this->views('paginas/about');
    }
 }