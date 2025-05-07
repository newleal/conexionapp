<?php

//Clase User que gestiona consultas de usuario

class User {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //validar si existe el email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email= :email');
        $this->db->bind(':email',$email, null);
        $row = $this->db->single();

        if($this->db->rowCount()> 0)
        {
            return true;
        }else{
            return false;
        }
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (name, email, password) VALUE (:name,:email, :password)');
        $this->db->bind(':name', $data['name'], null);
        $this->db->bind(':email', $data['email'], null);
        $this->db->bind(':password', $data['password'], null);

        $result = $this->db->execute();
        //ejecutar el script
        if($result)
        {
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email', $email, null);
        $user = $this->db->single();

        //validar el password
        if($user)
        {
            $validateHashPassord = $user['password'];

            if(password_verify($password,$validateHashPassord))
            {
                return $user;
            }
        }
        else{
            return false;
        }
    }

    //obtener usuar por id
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id= :id');
        $this->db->bind(':id', $id, null);
        $user = $this->db->single();

        if($user)
        {
            return $user;
        } else{
            return false;
        }
    }
}