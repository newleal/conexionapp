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
        //traemos la consulta
        $posts = $this->posts->getPosts();

        $data = ['titulo' => 'Bievenidos al ',
                 'posts' => $posts   
                ];

        $this->views('paginas/index', $data);
    }

    public function about()
    {
        $this->views('paginas/about');
    }
 }