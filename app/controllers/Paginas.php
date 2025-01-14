<?php

class Paginas extends Controller{

    private $postModel;

    public function __construct() {

        //echo 'Paginas cargadas';
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        $posts = $this->postModel->getPosts();

        $data = [
            'titulo' => 'Bienvenido',
            'posts' => $posts,
        ];
        $this->view('paginas/index', $data);
    }

    public function about()
    {
        $this->view('paginas/about');
    }
}