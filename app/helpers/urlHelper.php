<?php

/**
 * funciones de ayudas, para la aplicacion
 * helpers
 */

 function urlRedirect($pagina)
 {
    header('Location:' . ROOTRUL . '/' . $pagina);
 }