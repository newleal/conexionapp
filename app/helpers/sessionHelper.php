<?php

/**
 * helper que me ayuda a autoatizar mensajes flash
 */

 session_start();

 function flash($name, $message='', $class='alert alert-success')
 {
    //si hay nombre
    if(!empty($name))
    {
        if(!empty($message))
        {
            $_SESSION[$name] = $message;
            $_SESSION[$name.'_class'] = $class;
        }
        //si solo tenemos nombre
        elseif(isset($_SESSION[$name])){

            $class = isset($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : ''; 
            echo '<div class="' . $class . '"id="msh-flash">' . $_SESSION[$name] . '</div/>';

            //LIMPIAMOS DESPUES DE MOSTRAR
            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
        }
    }
 }