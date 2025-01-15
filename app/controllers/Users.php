<?php
/**
 * Clase users que gestiona los registros e ingresos de usuarios
 */

 class Users extends Controller{

    private $userModel;

    public function __construct(){

        $this->userModel = $this->model('User');
    }

    //registrar usuarios
    public function register()
    {
        //Verificar POST
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //validacion de campos
        } else {

            //envio de datos

            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            //cargar a la vista
            $this->view('users/register', $data);
        }        
    }

 }