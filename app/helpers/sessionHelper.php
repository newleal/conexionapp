<?php

session_start();

//helper del mensaje de sesio flash

function flash($name = '', $message = '', $class = 'alert alert-success')
{
    if (!empty($name)) {
        // Si tenemos nombre y mensaje, establecemos el mensaje flash
        if (!empty($message)) {
            $_SESSION[$name] = $message;
            $_SESSION[$name.'_class'] = $class;
        } 
        // Si solo tenemos nombre, mostramos el mensaje si existe
        elseif (isset($_SESSION[$name])) {
            $class = isset($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : '';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            // Limpiamos después de mostrar
            unset($_SESSION[$name]);
            unset($_SESSION[$name.'_class']);
        }
    }
}