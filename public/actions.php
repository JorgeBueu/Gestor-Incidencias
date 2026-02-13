<?php

//Si no es metodo POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    //Te manda para index de cabeza
    header("Location: index.php");
    exit;
}

require_once "../src/IncidenciaRepository.php";

//REVISAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAR
$accion = null;
const ACCIONES_PERMITIDAS = ["crear", "cerrar", "reabrir", "eliminar"];

if (isset($_POST["accion"])) {
    $accion = $_POST["accion"];

    //Si acción no está en el array de acciones permitidas
    if (!in_array($accion, ACCIONES_PERMITIDAS)) {
        //Te manda para index de cabeza
        header("Location: index.php");
        exit;
    }

    // creamos un objeto tipo incidencia para trabajar con el en cada accion
    $repo = new IncidenciaRepository();
}

switch ($accion) {
    case 'crear':
        //Si no recibe titulo, descripcion y estado
        if (!isset($_POST["titulo"], $_POST["descripcion"], $_POST["estado"])) {
            //Te manda para index de cabeza
            header("Location: index.php");
            exit;
        }

        $titulo = trim($_POST["titulo"]);
        $descripcion = trim($_POST["descripcion"]);
        $estado = $_POST["estado"];

        // llamamos al metodo de incidencia para añadirla a la base de datos
        $resultadoCreate = $repo->crearIncidencia($titulo, $descripcion, $estado);

        // si el metodo devuelve true redirecciona a index.php con get y un parametro = 1
        if ($resultadoCreate === true) {
            header("Location: index.php?accion=crear&resultado=1"); //1 = true
            exit;
            // si NO devuelve true redirecciona a index.php con get y un parametro = 2
        } else {
            header("Location: index.php?accion=crear&resultado=0"); //0 = false
            exit;
        }
        break;

    case 'cerrar':
        if (isset($_POST["id"])) {
            //guardamos el id de la incidencia que decide eliminar el usuario
            $id = (int) $_POST["id"];

            //usamos el metodo cerrar incidencia, le pasamos el id y guardamos el resultado en una variable
            $cerrada = $repo->cerrarIncidencia($id);

            //si retorna true
            if ($cerrada) {
                header("Location: index.php?accion=cerrar&resultado=1");
                exit;
                //sino
            } else {
                header("Location: index.php?accion=cerrar&resultado=0");
                exit;
            }
        }
        break;

    case 'reabrir':
        //Si existe $_POST["id"] es por que el usuario pulsó reabrir en alguna incidencia del index
        if (isset($_POST["id"])) {
            //guardamos el id de la incidencia que decide reabrir el usuario
            $id = (int) $_POST["id"];

            //usamos el metodo reabrir incidencia, le pasamos el id y guardamos el resultado en una variable
            $reabierta = $repo->reabrirIncidencia($id);

            //si retorna true
            if ($reabierta) {
                header("Location: index.php?accion=reabrir&resultado=1");
                exit;
                //sino
            } else {
                header("Location: index.php?accion=reabrir&resultado=0");
                exit;
            }
        }
        break;

    case 'eliminar':
        if (isset($_POST["id"])) {
            $id = (int) $_POST["id"];

            $eliminada = $repo->eliminarIncidencia($id);

            if ($eliminada) {
                header("Location: index.php?accion=eliminar&resultado=1");
                exit;
            } else {
                header("Location: index.php?accion=eliminar&resultado=0");
                exit;
            }
        }
        break;

    default:
        header("Location: index.php");
        exit;
        break;
}
