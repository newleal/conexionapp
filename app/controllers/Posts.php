<?php
/**
 * Contrlador que gestiona vistas y modelos
 */

 class Posts extends Controller {

    private $posts;

    public function __construct(){


    }

    public function index()
    {
        $this->view('posts/index');
    }
 }