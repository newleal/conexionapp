<?php

session_start();
//helper mensaje de sesion flash

function flash($name, $message = '', $class='alert alert-success')
{
    if(!empty($name))
    {
        //si tenemo snombre y mensaje, establecemos el mensaje flash
        if(!empty($message))
        {
            $_SESSION[$name] = $message;
            $_SESSION[$name.'_class'] = $class;
        }
        //si solo tenemos nombre, mostramos el mensaje si exise
        elseif(isset($_SESSION[$name]))
        {
            $class = isset($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : '';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            //limpiamos despues de mostrar
            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
        }
    }
}

   //comprbar si un usuario esta logueado
   function isLoggedIn()
   {
       if (isset($_SESSION['user_id']))
       {
           return true;
       } else {
           return false;
       }
   }