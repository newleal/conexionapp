<?php

/**
 * Controller Users para gestionar usuarios
 */

 class Users extends Controller{

    private $usermodel;

    public function __construct()
    {
        $this->usermodel = $this->model('User');
    }

    //registar usuarios
    public function register()
    {
        //validar si se esta enviado datos por post

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //validaicon de datos
            //sanitizar datos del formulario
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //agregar datos
            $data = [
                'name' => $post['name'],
                'email' => $post['email'],
                'password' => $post['password'],
                'confirm_password' => $post['confirm_password'],
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',

            ];

            //validar que vengan datos en la vista

            //--validar nombre
            if(empty($data['name']))
            {
                $data['name_err'] = 'Por favor ingresa el nombre';
            }

            //--validar email
            if(empty($data['email']))
            {
                $data['email_err'] = 'Por favor ingresa un email valido';
            } else {

                //validar sie registro ya existe en la aplicaicon
                if($this->usermodel->findUserByEmail($data['email']))
                {
                    $data['email_err'] = 'Ya existe un usuario registrado';
                }
            }

            //--validar password
            if(empty($data['password']))
            {
                $data['password_err'] = 'Por favor ingresa una contraseña';
            } else {

                if(strlen($data['password']) < 6)
                {
                    $data['password_err'] = 'La contraseña debe tener minimo 6 caracteres';
                }
            }

            //--validar confirm_password
            if(empty($data['confirm_password']))
            {
                $data['confirm_password_err'] = 'Por favor ingresa la confirmacion de la contraseña';
            } else {

                if($data['password'] != $data['confirm_password'])
                {
                    $data['confirm_password_err'] = 'Las contraseñas no coinciden, no son iguales';
                }
            }

            //validar si yo hay mensajes de errores
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']))
            {
                //se encripta la contraseña
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                //se registra usuario en db
                if($this->usermodel->register($data))
                {
                    redirect('users/login');
                }else{
                    die('Algo salio mal.');
                }
                
            } else{

                // enviar errores a la vista
                $this->views('users/register', $data);
            }


        } else {
            
            //retorno de informacion
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',

            ];

            //retorenar al vista
            $this->views('users/register', $data);
        }
    }

    public function login()
    {
        //validar si vien datos por post
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //sanitizamos la data de post
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_URL);

            //agregamos datos
            $data = [
                'email' => $post['email'],
                'password' => $post['password'],
                'email_err' => '',
                'password_err' => '',

            ];

            //validar si los campos estancompletos
            

        } else {

            //Iniciar la data
            $data = [

                'email' => '',
                'password' => '',
                'emaiil_err' => '',
                'password_err' => '', 

            ];

            //Cargar la vista
            $this->views('users/login', $data);
        }

    }
 }