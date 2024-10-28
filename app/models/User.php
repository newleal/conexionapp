<?php
/**
 * Modelo user para gestionar la transaccon a la base de datos
 */

 class User {

    private $db;

    public function __construct(){

        $this->db = new Database();
    }

    //validar si ya existe un registro en la base de datos
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
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

    //registrar usuarios
    public function register($data)
    {
        $this->db->query("INSERT INTO users (name, email, password) VALUES(:name, :email, :password)");

        $this->db->bind(':name', $data['name'], null);
        $this->db->bind(':email', $data['email'], null);
        $this->db->bind(':password', $data['password'], null);
        $this->db->execute();


        //validar si el registro se agrego a la db
        $register = $this->db->lastInsertId();

        if(!empty($register))
        {
            return true;

        } else {
            return false;
        }

    }

    //validar login de usuarios
    public function login($email, $password = null)
    {   
        $this->db->query("SELECT * FROM users WHERE email = :email");
        //enlace de parametros
        $this->db->bind(':email', $email, null);
        $this->db->execute();

        //obteneos el resultado
        $user = $this->db->single();

        
        //verificar si las password coinciden
        if($user)
        {
            
            $hashedPassword = $user->password;//obtengo la password del usuario
            
            if(password_verify($password, $hashedPassword))
            {
                return $user;
            }
        } else{
            return false;
        }
    }


 }