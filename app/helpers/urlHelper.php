<?php

//sencilla redirecicn a una pagina

function redirect($pagina)
{
    header('Location:'.URLROOT.'/'.$pagina);
}