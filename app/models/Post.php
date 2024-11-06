<?php
/**
 * Clase que gestiona/*consulta a la base de datos que
 */

 class Post {

    private $db;

    public function __construct() {

        $this->db = new Database(); 
    }

    //mostrar los registros
    public function getPosts()
    {
        $this->db->query("SELECT * FROM posts");
        $this->db->execute();
        return $this->db->resulSet();
    }

 }
