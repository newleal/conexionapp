<?php

/**
 * model User que gestiona los datos a la base de datos
 */

 class User {

    private $db;

    public function __construct(){

        $this->db = new Database();
    }

    //validate email exists
    public function findUserByEmail($email)
    {
        $this->db->query("SELECT * FROM users WHERE email=:email");
        $this->db->bind(':email', $email, null);
        $row = $this->db->single();

        //revisar conteo de filas
        if($this->db->rowCount() > 0)
        {
            return true;
        }else {
            return false;
        }
    }

    //register users
    public function register($data)
    {
        //ingreso de usuario a la base de datos
        $this->db->query("INSERT INTO users (name, email, password) VALUES(:name, :email, :password)");
        $this->db->bind(':name', $data['name'], null);
        $this->db->bind(':email', $data['email'], null);
        $this->db->bind(':password', $data['password'], null);
        
        //ejecucion del script
        if($this->db->execute())
        {
            return true;
        }else {
            return false;
        }
        
    }

    //login  users
    public function login($data)
    {}
 }