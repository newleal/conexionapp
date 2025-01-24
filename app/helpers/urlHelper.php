<?php

//Sencilla redireccion a una pagina
function redirect($pagina)
{
    header('location:' . URLROOT . '/' . $pagina);
}