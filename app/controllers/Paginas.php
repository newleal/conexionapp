<?php

/**
 * Clase paginas
 * carga la vistea del usuaro loggeado
 */

 class Paginas extends Controller{

    //vatiale de instancia del modelo pagina
    private $postsModel;

    public function __construct(){
        
        $this->postsModel = $this->model('Pagina');
    }

    public function index()
    {
        //traer el resultado de la consulta
        $posts = $this->postsModel->getPosts();
        $data = [
            'titulo' => 'Bienvenidos al index',
            'posts' => $posts,
        ];
        $this->view('paginas/index', $data);
    }

    public function about()
    {
        $this->view('paginas/about');
    }
 }