<?php
/**
 * Contrlador Users que gestiona registros e inicios de sesion
 */

 class Users extends Controller {

    private $userModel;

    public function __construct(){

        $this->userModel = $this->model('User');
    }

    //registro de usuarios
    public function register()
    {
        //validar si viene datos por posts
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //guardar los datos de formulario
            $data = [
                'name' => $POST['name'],
                'email' => trim($POST['email']),
                'password' => trim($POST['password']),
                'confirm_password' => trim($POST['confirm_password']),
                'name_err' => '',
                'email_ee' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            //validar nombre
            if(empty($data['name']))
            {
                //mensaje de error
                $data['name_err'] = 'Ingresa un nombre';
            }

            //validar email
            if(empty($data['email']))
            {
                //mensaje de error
                $data['email_err'] = 'Por favor ingresa un correo electronico';
            }else {
                //validar si el correo existe en al DB
                if($this->userModel->findUserByEmail($data['email']))
                {
                    $data['email_err'] = 'ese correo ya esta registrado';
                }

            }

            //validar password
            if(empty($data['password']))
            {
                //validar passowrd si viene vacio
                $data['password_err'] = 'Ingresa una contraseña';
            }elseif(strlen($data['password']) < 6)
            {
                $data['password_err'] = 'La contraseña debe tener minimo 6 caracteres';
            }

            //validar confirm password
            if(empty($data['confirm_password']))
            {
                $data['confirm_password_err'] = 'Ingresa la contraseña de confirmacion';
            }elseif($data['password'] != $data['confirm_password'])
            {
                $data['confirm_password_err'] = 'Las contraseñas no coinciden';
            }

            //valdiar todos los campo de error se encuentren vacios
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']))
            {
                //validado
                //se jashea la contraseña
                //$data['password'] = has

                die('Exitoso');
            }else {
                //carga de array data con los errores
                $this->view('users/register', $data);
            }


        } else {

            //devuelve datos
            $data = [

                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
            ];

            //envio de datos a la vista 
            $this->view('users/register', $data);
        }
    }

    //login de usuarios
    public function login() 
    {
        //validar si viene datos por posts
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //guardar los datos de formulario
            $data = [
                'email' => trim($POST['email']),
                'password' => trim($POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];


            //validar email
            if(empty($data['email']))
            {
                //mensaje de error
                $data['email_err'] = 'Por favor ingresa un correo electronico';
            }

            //validar password
            if(empty($data['password']))
            {
                //validar passowrd si viene vacio
                $data['password_err'] = 'Ingresa una contraseña';
            }elseif(strlen($data['password']) < 6)
            {
                $data['password_err'] = 'La contraseña debe tener minimo 6 caracteres';
            }


            //valdiar todos los campo de error se encuentren vacios
            if(empty($data['email_err']) && empty($data['password_err']))
            {
                //validado
                //se jashea la contraseña
                //$data['password'] = has

                die('Exitoso');
            }else {
                //carga de array data con los errores
                $this->view('users/login', $data);
            }

        } else {

            //devuelve datos
            $data = [

                'email' => '',
                'password' => '',
            ];

            //envio de datos a la vista 
            $this->view('users/login', $data);
        }        
    }
 }
