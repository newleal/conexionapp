<?php

/**
 * Modelo para valda conexion a la base de datos
 */

 class Post extends Database{

    private $db;

    public function __construct(){

        return $this->db = new Database();
    }

    //Lalamado de datos de la consulta
    public function getPosts()
    {
        $this->db->query('SELECT * FROM posts');
        return $this->db->resulSet();
    }
 }