<?php
/**
 * Clase User del modelo gestiona las respuestas
 */

 class User {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //validar si un usuario existe
    public function getUserByEmail($email)
    {
        $this->db->query("SELECT * from users WHERE email=:email");
        $this->db->bind(':email', $email, null);
        $this->db->single();

        if($this->db->rowCount())
        {
            return true;
        }else{
            return false;
        }
    }

    //regitro de usuarios
    public function register($data)
    {
        $this->db->query("INSERT INTO users (name, email, password) VALUES(:name, :email, :password)");
        $this->db->bind(':name', $data['name'], null);
        $this->db->bind(':email', $data['email'], null);
        $this->db->bind(':password', $data['password'], null);
        $this->db->execute();

        $newUser = $this->db->lastInsertId();

        if($newUser)
        {
            return true;
        } else {
            return false;
        }
    }
 }