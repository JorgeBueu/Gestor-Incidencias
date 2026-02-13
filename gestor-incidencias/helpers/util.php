<?php

function validarId($id)
{
    $id = (int) $id;

    //Si id es menor o igual a 0 
    if ($id <= 0) {
        redirectIndex();
    }

    return $id;
}