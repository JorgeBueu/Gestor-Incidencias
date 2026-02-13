<?php

//Para acceder a constantes en una funcion NO hace falta poner global, por defecto las const son globales
//Solo hace falta poner global para las varibales
const FLASH_MESSAGES = [
        "crear" => [1 => "Incidencia creada con éxito.", 0 => "Error al crear la incidencia."],
        "cerrar" => [1 => "Incidencia cerrada con éxito.", 0 => "Error al cerrar la incidencia."],
        "reabrir" => [1 => "Incidencia reabierta con éxito.", 0 => "Error al reabrir la incidencia."],
        "eliminar" => [1 => "Incidencia eliminada con éxito.", 0 => "Error al eliminar la incidencia."]
    ];

/**
 * Devuelve un array con el color y el mensaje si todo sale bien o null si algo falla
 * comprueba la accion y segun el resultado sea 1 o 0,
 * devuelve un mensaje de exito o fallo y un color acorde.
 *
 * @return array con el color y el mensaje
 * @return null si ocurre algún error
 */
function getFlashMessage(): ?array
{

    //Si no existe $_GET["accion"] o no existe $_GET["resultado"] devolvemos null
    if (!isset($_GET["accion"]) || !isset($_GET["resultado"])) {
        return null;
    }

    //Si existen los guardamos en variables
    $accion = $_GET["accion"];
    $resultado = (int) $_GET["resultado"];

    //Si no existe FLASH_MESSAGES[$accion][$resultado] devolvemos null
    if (!isset(FLASH_MESSAGES[$accion][$resultado])) {
        return null;
    }

    //Si existe esa posicion en el array FLASH_MESSAGES, devolvemos un array con el color y el mensaje
    return [
        //IF PRO -> Si $resultado es === a 1 "success" sino "danger"
        "color" => $resultado === 1 ? "success" : "danger",
        "mensaje" => FLASH_MESSAGES[$accion][$resultado]
    ];
}
