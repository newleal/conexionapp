<?php

//sencilla redirecicn a una pagina

function redirect($pagina)
{
    header('Location:'.URLROOT.'/'.$pagina);
}

function redirectSinLocation($pagina)
{
    echo URLROOT.'/'.$pagina;
}