<?php

class Paginas extends Controller {

    private $postModel;
    
    public function __construct() {

        
    }

    public function index()
    {
        

        $data = array(
            'tituloPagina' => 'Resultado de Posts',
            
        );
        $this->view('paginas/index', $data);
    }

    public function about()
    {
        $this->view('paginas/about');
    }
}