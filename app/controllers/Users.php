<?php

/*
Clase Users que gestiona los usuarios

*/

class Users extends Controller{

    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    //metodo que gestiona registros nuevos
    public function register()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //GESTIONAR LA PETICION

            //sanitizams los datoa que viene por POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => $_POST['name'],
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
            ];

            //Validar campos

            //validar nombre
            if(empty($data['name']))
            {
                $data['name_err'] = "Falta ingresar el nombre";
            }

            //validar email
            if(empty($data['email']))
            {
                $data['email_err'] = "Falta ingresar el email";

            } else {

               
                if($this->userModel->findUserByEmail($data['email']))
                {
                    $data['email_err'] = "Este email ya esta registrado";
                }

            }

            //validar password
            if(empty($data['password']))
            {
                $data['password_err'] = "Falta ingresar una contraseña";
            } else if(strlen($data['password']) <6){
                $data['password_err'] = "la contraseña debe contener minima de 6 caracteres";
            }

            //valida la conformacion de la contraseña
            if(empty($data['confirm_password']))
            {
                $data['confirm_password_err'] = "Falta confirmar la contraseña";
            }else {
                if($data['confirm_password'] != $data['password'])
                {
                    $data['confirm_password_err'] = "Las contraseñas no son iguales";
                }
            }

            //asegurarse que los errores estan vacios
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']))
            {
                
                //hasear la contraseña
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                
                if($this->userModel->register($data))
                {
                    flash('register_success','Te has registrado correctamente, ahora puedes inciar sesion');
                    redirect('users/login');
                }else {
                    flash('register_error','Algo salio mal con el registro', 'alert alert-danger');
                    //die('Algo malo paso');
                    $this->view('users/register');
                }

            }else {
                //mostrar los errores el la vista register
                $this->view('users/register', $data);
            }


        } else {
            //devuelve los datos vacios
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

    //metodo que procesa el login
    //metodo que gestiona registros nuevos
    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];

            //validar email
            
            if(empty($data['email']))
            {
                $data['email_err'] = "Falta ingresar el email.";
                
            }elseif($this->userModel->findUserByEmail($data['email']) == false){
                $data['email_err'] = "El usuario no existe.";
            }

            //validar password
            if(empty($data['password']))
            {
                $data['password_err'] = "Falta ingresar una contraseña";
            }


            //asegurarse que los errores estan vacios
            if(empty($data['email_err']) && empty($data['password_err']) )
            {
                //Validado
                //die('Registo exitoso');
                $user = $this->userModel->login($data['email'], $data['password']);
                if($user)
                {
                    //creamos variable de sesion
                    $this->createUserSession($user);
                    //die('success');
                    
                }else {
                    $data['password_err'] = 'La conreaseña es incorrecta';
                    $this->view('users/login', $data);
                }

            }else {
                //mostrar los errores el la vista register
                $this->view('users/login', $data);
            }


        } else {
            //devuelve los datos vacios
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];

            $this->view('users/login', $data);
        }
    }

    //crear la sesion del usuario
    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];

        redirect('posts/index');
    }

    //crear el cierre de sesion
    public function logout()
    {
        //eliminar las variables de sesion
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);

        session_destroy();//destruye la sesion

        redirect('users/login');
    }

    


}