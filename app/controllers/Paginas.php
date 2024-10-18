<?php

/**
 * crear la clase Paginas
 */

 class Paginas extends Controller{

    private $postModel;
    
    public function __construct() {
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        
        $posts = $this->postModel->getPosts();

        $data = [
            'titulo' => 'Datos de los Posts',
            'posts'  => $posts,
        ];

        $this->view('paginas/index', $data);
    }

    public function about()
    {
        $this->view('paginas/about');
    }
 }