<?php

/**
 * clase controlador Users
 */

 class Users extends Controller{

    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    //registar usuarios
    public function register()
    {

        //validar si se envian datos por posts
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //sanitizar los valores
            $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_URL);

            // Agregar los datos al array data
            //devolver arreglo vacio
            $data = [
                'name' => $POST['name'],
                'email' => $POST['email'],
                'password' => $POST['password'],
                'confirm_password' => $POST['confirm_password'],
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',

            ];

            //validar los campo nombre
            if(empty($data['name']))
            {
                $data['name_err'] = 'Ingresa un nombre';
            }

            //validar campo email
            if(empty($data['email']))
            {
                $data['email_err'] = 'Ingresa un email';
            }else {

                //validar sie registro ya existe en la aplicaicon
                if($this->userModel->findUserByEmail($data['email']))
                {
                    $data['email_err'] = 'Ya existe un usuario registrado';
                }

            }

            //validar contraseña
            if(empty($data['password']))
            {
                $data['password_err'] = 'Ingresa una contraseña';                 
            } else{
                if(strlen($data['password']) < 6){
                    $data['password_err'] = 'La contraseña debe tener al menos 6 caracteres';
                }                 
            }

            //valida confirmacion de password
            if(empty($data['confirm_password']))
            {
                $data['confirm_password_err'] = 'Ingresa la confirmacion de contraseña';
            }else{
                if($data['confirm_password'] != $data['password']){
                    $data['confirm_password_err'] = 'Las contraseña no coinciden, no son iguales';
                }
            }



            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']))
            {
                //encriptar la contraseña
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if($this->userModel->register($data))
                {

                    //registro exitoso
                    flash('register-success','Registro exitoso, puedes ingresar!');
                    urlRedirect('users/login');
                }

            } else{

                //llevar los datos de error a la vista
                $this->view('users/register', $data);
            }


        } else {

            //devolver arreglo vacio
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

            //vargar datos a la vista
            $this->view('users/register', $data);
        }


    }


    //loginde usuarios
    public function login()
    {
       //validar si se envian datos por posts
       if(isset($_SERVER['REQUEST_METHOD']) == 'POST')
       {
           //sanitizar los valores
           $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_URL);

           // Agregar los datos al array data
            $data = [
                'email' => $POST['email'],
                'password' => $POST['password'],
                'email_err' => '',
                'password_err' => '',
            
            ];

            //validar campo email
            if(empty($data['email']))
            {
                $data['email_err'] = 'Ingresa un email';
            }else {

                //validar sie registro ya existe en la aplicaicon
                if(empty($this->userModel->findUserByEmail($data['email'])))
                {
                    $data['email_err'] = 'La cuenta no esta registrada';
                }

            }

            $user = $this->userModel->login($data['email'], $data['password']);

            //validar contraseña
            if(empty($data['password']))
            {
                $data['password_err'] = 'Ingresa una contraseña';                 
            } else{
                if($user){
                    
                    //creamos variables de session

                    urlRedirect('posts');
                }else {
                    $data['password_err'] = 'LA contrasea o el correo no son  correctos';
                }                 
            }

            //si no hay errores
            if(empty($data['email_err']) && empty($data['password_err']))
            {
                ///
            }else{
                $this->view('users/login', $data);
            }

        } else {

           //devolver arreglo vacio
           $data = [
               'email' => '',
               'password' => '',
               'email_err' => '',
               'password_err' => '',
               
           ];

           //vargar datos a la vista
           $this->view('users/login', $data);
       } 
    }


 }