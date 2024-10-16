<?php

/**
 * Cargamos el controaldor generico llamapd Paginas
 */

class Paginas extends Controller{

    private $postModel;

    public function __construct(){
        //echo 'Hola mundo desde controlador Paginas';
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        $posts = $this->postModel->getPosts();

        $data = [
            'titulo' => 'Bienvenidos al Index',
            'posts'  => $posts,
        ];

        
        $this->view('paginas/index', $data);
    }

    public function about()
    {
        $this->view('paginas/about');
    }
} 