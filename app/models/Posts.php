<?php
/**
 * hacemos la conexion con la base de datos pareala consulta
 * 
 */

 class Posts{

    private $db;

    public function __construct(){

        $this->db = new Database();
    }

    public function getPosts(){
        $this->db->query("SELECT * from posts");

        return $this->db->resulSet();
    }

    
 }

