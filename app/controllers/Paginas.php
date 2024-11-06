<?php

/**
 * clase Paginas que muestra informacion si no hay contrladores asociados
 */

 class Paginas extends Controller {

    private $postsModel;

    public function __construct(){
       // echo 'saludos desde controlador Paginas';
       $this->postsModel = $this->model('Post');
    }

    public function index()
    {
        $posts = $this->postsModel->getPosts();

        $data = [
            'posts' => $posts,
            'titulo' => 'Bienvenidos'
        ];

        $this->view('paginas/index', $data);
    }

    public function about()
    {
        $this->view('paginas/about');
    }
 }