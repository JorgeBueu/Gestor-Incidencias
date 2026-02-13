<?php

require_once("../helpers/redirects.php");

//Si no es metodo POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirectIndex();
}

//Si $_POST["accion"] no existe
if (!isset($_POST["accion"])) {
    redirectIndex();
}

const ACCIONES_PERMITIDAS = ["crear", "cerrar", "reabrir", "eliminar"];
const ESTADOS_PERMITIDOS = ["Abierta", "Cerrada"];
$accion = $_POST["accion"];

//Si acción no está en el array de acciones permitidas
if (!in_array($accion, ACCIONES_PERMITIDAS)) {
    redirectIndex();
}

require_once "../src/IncidenciaRepository.php";
require_once "../helpers/util.php";
// creamos un objeto tipo incidencia para trabajar con el en cada accion
$repo = new IncidenciaRepository();

switch ($accion) {
    case 'crear':
        
        //Si no recibe titulo, descripcion y estado
        if (!isset($_POST["titulo"], $_POST["descripcion"], $_POST["estado"])) {
            redirectIndex();
        }

        $titulo = trim($_POST["titulo"]);
        $descripcion = trim($_POST["descripcion"]);
        $estado = $_POST["estado"];

        //Si $titulo o $descripcion son menores de 3 caracteres
        if (strlen($titulo) < 3 || strlen($descripcion) < 3) {
            redirectIndex();
        }

        //Si $estado no está en los estados permitidos
        if (!in_array($estado, ESTADOS_PERMITIDOS)) {
            redirectIndex();
        }

        // llamamos al metodo de incidencia para añadirla a la base de datos
        $resultadoCrear = $repo->crearIncidencia($titulo, $descripcion, $estado);
        redirectAccionResultado($accion, $resultadoCrear);        
        break;

    case 'cerrar':
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $id = validarId($id);

            //usamos el metodo cerrar incidencia, le pasamos el id y guardamos el resultado en una variable
            $resultadoCerrada = $repo->cerrarIncidencia($id);
            redirectAccionResultado($accion, $resultadoCerrada);
        }
        break;

    case 'reabrir':
        //Si existe $_POST["id"] es por que el usuario pulsó reabrir en alguna incidencia del index
        if (isset($_POST["id"])) {
            //guardamos el id de la incidencia que decide reabrir el usuario
            $id = (int) $_POST["id"];

            //Si id es menor o igual a 0 
            if ($id <= 0) {
                redirectIndex();
            }

            //usamos el metodo reabrir incidencia, le pasamos el id y guardamos el resultado en una variable
            $resultadoReabierta = $repo->reabrirIncidencia($id);
            redirectAccionResultado($accion, $resultadoReabierta);
        }
        break;

    case 'eliminar':
        if (isset($_POST["id"])) {
            $id = (int) $_POST["id"];

            //Si id es menor o igual a 0 
            if ($id <= 0) {
                redirectIndex();
            }

            $resultadoEliminada = $repo->eliminarIncidencia($id);
            redirectAccionResultado($accion, $resultadoEliminada);
        }
        break;

    default:
        redirectIndex();
        break;
}
