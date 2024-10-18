<?php
/**
 * Clase modelsopara porbar conexion
 */

 class Post {

    private $model;

    public function __construct(){

        $this->model = new Database();
    }

    //Metodo para traer datos de la DB
    public function getPosts()
    {
        $this->model->query('SELECT * FROM posts');
        return $this->model->resulSet();
    }
 }