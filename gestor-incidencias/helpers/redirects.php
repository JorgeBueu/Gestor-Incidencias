<?php

/**
 * Redirecciona a index.php
 *
 * @return void
 */
function redirectIndex(): void
{
    header("Location: index.php");
    exit;
}

/**
 * Redirecciona a index.php
 * Además envia con get una accion y resultado para saber que mensaje mostrar
 *
 * @return void
 */
function redirectAccionResultado(string $accion, bool $resultado): void
{
    if ($resultado === true) {
        header("Location: index.php?accion={$accion}&resultado=1"); //1 = true
        exit;
        // si NO devuelve true redirecciona a index.php con get y un parametro = 2
    } else {
        header("Location: index.php?accion={$accion}&resultado=0"); //0 = false
        exit;
    }
}