<?php
/**
 * Clase que gestiona las conultas de a la base de datos
 */

 class Pagina {

    private $db;

    public function __construct(){

        $this->db = new Database();
    }

    //pasa datos de posts
    public function getPosts()
    {
        $this->db->query("SELECT * FROM posts");
        
        return $this->db->resulSet();
    }
 }