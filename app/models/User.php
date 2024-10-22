<?php
/**
 * 
 * Clase User
 */

 class User {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //consultar si existe un usuario antes del reegistro en la db
    public function findUserByEmail($email){

        //Encontrar un usuario pore email
        $this->db->query("SELECT * FROM users WHERE email =:email");
        $this->db->bind(":email",$email, null);

        $row = $this->db->single();

        //revisamos conteo de filas
        if($this->db->rowCount() > 0)
        {
            return true;
        } else {
            return false;
        }

    }

    //registrar un usuario

    public function register($data)
    {
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        $this->db->bind(':name', $data['name'], null);
        $this->db->bind(':email', $data['email'], null);
        $this->db->bind(':password', $data['password'], null);
        $this->db->execute();

        $row = $this->db->rowCount();
        
        $lastInsertID = $this->db->lastInsertId();
        //ejecutar la consulta
        if(!empty($lastInsertID))
        {
            return true;
         

        } else {
            return false;
        }
    }

 }