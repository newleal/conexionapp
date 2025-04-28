<?php

function redirect($pagina)
{
    header('location: '.URLROOT.'/'. $pagina);
}