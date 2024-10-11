<?php

class Users extends Controller{

    public function __construct(){


    }

    //metodo para registrar datos
    public function register()
    {
        //verificar metodo POST
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //Procesa el formulario
            //sanitizamos lso datos que vienen por POST
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name'    => trim($post['name']),
                'email'   => trim($post['email']),
                'password'=> trim($post['password']),
                'confirm_password' => trim($post['confirm_password']),
                'email_err' => "",
                'name_err' => "",
                'password_err' => "",
                'confirm_password_err' => "",
            ];

            //validar los campos
            // validamos nombres
            if(empty($data['name']))
            {
                $data['name_err'] = 'Por favor ingrese el nombre completo';
            }

            //validamos email
            if(empty($data['email']))
            {
                $data['email_err'] = 'Por favor ingrese un email';
            }

            //validar la contraseña
            if(empty($data['password']))
            {
                $data['password_err'] = 'La contraseña debe tener por lo menos 6 caracteres';
            }

            //validar la confirmacion del password
            if(empty($data['confirm_password']))
            {
                $data['confirm_password_err'] = 'Porfavor ingrese la contgraseña de confirmacion';
            } else {
                if($data['password'] != $data['confirm_password'])
                {
                    $data['confirm_password_err'] = 'Las contraseñas no son iguales, no coinciden';
                }
            }

            //asegurase que los errores esten vacios
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']))
            {
                //validado
                die('Registro Exitoso!!!');
            } else {
                // Carga el register con el array de erroresy se imprimen en el formulario
                $this->view('/users/register', $data);
            }

        } else {
            //iniciar la data
            $data = [
                'name'    => "",
                'email'   => "",
                'password'=> "",
                'confirm_password' => "",
                'email_err' => "",
                'name_err' => "",
                'password_err' => "",
                'confirm_password_err' => "",
            ];

            //Cargar la vista
            $this->view('users/register', $data);
        }
    }

    //Metodo para el login
    public function login()
    {
        //verificar post
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //procesa el formulario
        } else {
            //Iniciar la data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'passwprd_err' => ''
            ];

            //cargar la vista
            $this->view('users/login',$data);
        }
    }
}