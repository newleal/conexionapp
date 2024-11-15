<?php

/**
 * Clase Users que gestiona registros y login
 */

 class Users extends Controller {

    private $userModel;

    public function __construct(){
        
        $this->userModel = $this->model('User');

    }

    //Metodo register
    public function register()
    {
        //valdia is vienen datos por post
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
          //procesar los datos recibidos
          $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          
          //Carga de datos
          $data = [
                'name' => rtrim(ltrim($post['name'])),
                'email' => trim($post['email']),
                'password' => trim($post['password']),
                'confirm_password' => $post['confirm_password'],
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            //validar campo name
            if(empty($data['name']))
            {
                $data['name_err'] = 'Ingresa un nombre';
            }
            
            //validar campo email
            if(empty($data['email']))
            {
                $data['email_err'] = 'Por favor ingresa un correo';
            }

            //validar campo password
            if(empty($data['password']))
            {
                $data['password_err'] = 'Ingresa una contraseña';
            }else {

                if(strlen($data['password']) < 6){
                    $data['password_err'] = 'La contraseña debe se mayo a 6 caracteres';
                }
            }

            //validar confirmacio de password
            if(empty($data['confirm_password']))
            {
                $data['confirm_password_err'] = 'Ingresa una contraseña';
            } else {

                if($data['password'] != $data['confirm_password'])
                {
                    $data['confirm_password_err'] = 'Las contraseñas no son iguales no coinciden';
                }
            }

            //si la data de erro esta vacia
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']))
            {
                if($this->userModel->getUserByEmail($data['email']))
                {
                    $data['email_err'] = 'el usuario ya existe';
                }else {

                    //encriptarla contraseña
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    if($this->userModel->register($data))
                    {

                        die('registro exitoso');
                    }
                }
                

            } else {

                $this->view('users/register', $data);
            }

        } else{

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

            $this->view('users/register', $data);
        }
    }
 }