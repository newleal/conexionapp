<?php

//controlador paginas

class Paginas extends Controller{

    private $postModel;

    public function __construct()
    {
        //echo 'Constructor paginas';
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        if(isLoggedIn())
        {
            redirect('posts');
        }

        $posts = $this->postModel->getPosts();
        $data = [
            'titulo' => 'Bienvenidos Tod@s',
            'posts' => $posts
        ];
        $this->view('paginas/index', $data);
    }

    public function about()
    {
        $this->view('paginas/about');
    }
}