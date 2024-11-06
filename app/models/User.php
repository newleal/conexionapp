<?php

/**
 * Clase User en molde que gestiona la data de la base de datos
 */

 class User {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    //validar email existente en el registro
    public function findUserByEmail($email)
    {
        
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email, null);
        $this->db->execute();

        //validamos conteo de regstros en db
        
        if($this->db->rowCount() > 0)
        {
            return true;
        }else {
            return false;
        }
    }

    //registrar usuario
    public function register($data)
    {
        $this->db->query("INSERT INTO users (name, email, password) VALUES(:name, :email, :password)");
        $this->db->bind(':name', $data['name'], null);
        $this->db->bind(':email', $data['email'], null);
        $this->db->bind(':password', $data['password'], null);
        $this->db->execute();

        //veriricacion de ingreo de registro

        if($this->db->lastInsertId())
        {
            return true;
        } else {
            return false;
        }
    }

    //valdar login
    public function login($email, $password=null)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email, null);
        $this->db->execute();

        $user = $this->db->single();

        if($user)
        {
            $hashedPassword = $user->password;

            if(password_verify($password, $hashedPassword))
            {
                return $user;
            }
        }else {
            return false;
        }
    }

    public function rowCount()
    {
        return $this->db->rowCount();
    }


 }