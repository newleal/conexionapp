<?php
/**
 * Clase modelo Post que realiza cosultas a la base de datos
 */

 class Post{

    private $db;

    public function __construct(){
        //instanciamos a la calse Database
        $this->db = new Database();
    }

    //consultamos la db
    public function getPosts()
    {
        //realizamos la consulta
        $this->db->query('SELECT * FROM posts');

        //retornamos la respuesta
        return $this->db->resulSet();
    }
 }