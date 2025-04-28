<?php

session_start();

function flash($name='', $message='', $class='alert alert-success' )
{
    if(!empty($name))
    {
        //para guardar un mesaje en la sesion
        if(!empty($message))
        {
            //limpiar cualquier mesaje existente
            if(!empty($_SESSION[$name]))
            {
                unset($_SESSION[$name]);
            }

            if(!empty($_SESSION[$name.'_class']))
            {
                unset($_SESSION[$name.'_class']);
            }

            //guardar un nuevo mensaje
            $_SESSION[$name] = $message;
            $_SESSION[$name. '_class'] = $class;
        
            //para mostrar un mesaje desde la sesion
        }elseif(!empty($_SESSION[$name]))
        {
            $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
            echo '<div class="' . $class .'"id="msh-flash">' . $_SESSION[$name] . '</div>;';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']); 
        }
        
    }
}

//metodo que valdia si el usuario esta loggueado
function isLoggedIn()
{
    if(isset($_SESSION['user_id']))
    {
        return true;
    } else{
        return false;
    }
}