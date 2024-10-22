<?php

/**
 * Clase users para gestionar usuarios
 */

 class Users extends Controller{

    private $userModel;

    public function __construct(){
        $this->userModel = $this->model('User');
    }

    //Metodo registar
    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //procesar el formulario
            //Validaicon de formulario 
            //Validacion de formulario 
            //Sanitizamos los datos del formulario
            $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING );
                
            $data = [

                'name' => trim($POST['name']),
                'email' => trim($POST['email']),
                'password' => trim($POST['password']),
                'confirm_password' => trim($POST['confirm_password']),
                'name_err' => '',
                'emaiil_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',

            ];    

            //validar los datos nombre
            if(empty($data['name']))
            {
                $data['name_err'] = 'Por favor ingrese el nombre';
            }

            //validar los datos email
            if(empty($data['email']))
            {
                $data['email_err'] = 'Por favor ingrese el email';
            } else {
                //validar si el email ya existe en la DB
                if($this->userModel->findUserByEmail($data['email']))
                {
                    $data['email_err'] = 'Ya existe un email registrado';
                }
            }

            //validar los datos password
            if(empty($data['password']))
            {
                $data['password_err'] = 'Por favor ingrese la contraseña';
            } else{
                if(strlen($data['password']) < 6){
                    $data['password_err'] = 'la contraseña debe tener por lo menos 6 caracteres';
                }
            }

            //validamos el confirm del password
            if(empty($data['confirm_password']))
            {
                $data['confirm_password_err'] = 'Por favor ingrese la contraseña de confirmacion';
            } else {

                if($data['confirm_password'] != $data['password'])
                {
                    $data['confirm_password_err'] = 'Las contraseña no coinciden, no son iguales';
                }
            }

            //asegurarnos que los errores esten vacios
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']))
            {
                //validado
                //cifar la contraseña
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //registrar usuario
                if($this->userModel->register($data))
                {
                    
                    flash('register_success', 'Ya estas registrado puedes inciar sesión');
                    redirect('users/login');
                } else {
                    var_dump($this->userModel->register($data));
                    redirectSinLocation('users/login');
                    die('Algo malo sucedio');
                }

            } else {

                //Envio de errores a la vista de user register y se mostrar en el formulario
                $this->view('users/register', $data);
            }

        } else {

            //Iniciar la data
            $data = [

                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'emaiil_err' => '',
                'password_err' => '',
                'confirm_password' => '',
                'confirm_password_err' => '',

            ];

            //Cargar la vista
            $this->view('users/register', $data);
        }
    }

    //Metodo login
    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //procesar el formulario
            //Obtener los datgos del formulario
            $POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Limpiar los datos en $data
            $data = [
                'email' => trim($POST['email']),
                'password' => trim($POST['password']),
                'emaiil_err' => '',
                'password_err' => '',
            ];

            //valdiar que los campos vengan con informacion
            if(empty($data['email']))
            {
                $data['email_err'] = 'Por favor ingresa el email';
            }

            if(empty($data['password']))
            {
                $data['password_err'] = 'Por favor ingresa la contraseña';
            }

            //valdiamos que no existan mesajes de erro
            if(empty($data['password_err']) && empty($data['password_err']))
            {
                die('Login Exitoso!');
            } else {
                //cargamos la vista con los errores
                $this->view('users/login', $data);
            }

        } else {

            //Iniciar la data
            $data = [

                'email' => '',
                'password' => '',
                'emaiil_err' => '',
                'password_err' => '',   

            ];

            //Cargar la vista
            $this->view('users/login', $data);
        }
    }
 }