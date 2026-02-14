<?php

// 🎯 Si lo retomas ahora
// Lo siguiente lógico sería:
// Añadir filtro por estado
// Añadir ordenación
// Añadir fecha creación automática
// Añadir validaciones más estrictas backend
// Añadir paginación
// Añadir usuarios
// Eso ya lo convertiría en mini GLPI.

require_once "../src/IncidenciaRepository.php";
require_once "../helpers/flash.php";

// creamos un objeto tipo incidencia
$repo = new IncidenciaRepository();

if (isset($_GET["estado"])) {
    if ($_GET["estado"] == "Abierta") {
        $incidencias = $repo->findByEstado("Abierta");
    } else if ($_GET["estado"] == "Cerrada"){
        $incidencias = $repo->findByEstado("Cerrada");
    }
} else {
    // llamamos al metodo findAll de incidencia que nos retorna un array con todas las incidencias que tenemos en la BD
    $incidencias = $repo->findAll();
}

// Llamamos al método que muestra las alertas de crear, cerrar, eliminar y reabrir las incidencias, con o sin éxito.
$flash = getFlashMessage();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Gestor de incidencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>Incidencias</h1>

        <br>
        <?php if ($flash) { ?> <!-- Si $flash es null == false, Si $flash es array == true -->
            <div class="alert alert-<?= $flash["color"]; ?>" role="alert"> <?= $flash["mensaje"]; ?></div>
        <?php } ?>

        <a href="crear.php" class="btn btn-primary mb-3">Nueva incidencia</a>

        <!-- Tabla de filtros -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th colspan="3">Búsqueda por estado de incidencia</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <a href="index.php" class="btn btn-primary mb-3">Todas</a>
                    </td>
                    <td>
                        <a href="index.php?estado=Abierta" class="btn btn-success mb-3">Abiertas</a>
                    </td>
                    <td>
                        <a href="index.php?estado=Cerrada" class="btn btn-danger mb-3">Cerradas</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Tabla de incidencias -->
        <table class="table table-bordered table-striped"> <!-- Opcional: table-dark -->
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($incidencias as $incidencia) { ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($incidencia["id"]) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($incidencia["titulo"]) ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($incidencia["descripcion"]) ?>
                        </td>
                        <td>
                            <!-- Esto es equivalente a abrir php echo cerrar php -->
                            <?= htmlspecialchars($incidencia["estado"]) ?>
                        </td>
                        <td>
                            <!-- Si el estado de la incidencia es "Abierto" vamos a mostrar un boton que pone cerrar -->
                            <?php if ($incidencia["estado"] == "Abierta") { ?>
                                <!-- Si el usuario pulsa cerrar se va a enviar el id de la incidencia que se desea cerrar a cerrar.php -->
                                <form action="actions.php" method="post">
                                    <input type="hidden" class="form-control" name="accion" value="cerrar">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $incidencia["id"]; ?>">
                                    <button type="submit" class="btn btn-warning">Cerrar 🔒</button>
                                </form>
                            <?php } ?>
                            <!-- Si el estado de la incidencia es "Cerrada" vamos a mostrar un boton que pone eliminar -->
                            <?php if ($incidencia["estado"] == "Cerrada") { ?>
                                <!-- Si el usuario pulsa eliminar va a preguntar si quiere eliminar, si pulsa si se va a enviar el id de la incidencia a eliminar.php -->
                                <form action="actions.php" method="post" onsubmit="return confirm('¿Seguro que quieres eliminar esta incidencia?');">
                                    <input type="hidden" class="form-control" name="accion" value="eliminar">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $incidencia["id"]; ?>">
                                    <button type="submit" class="btn btn-danger">Eliminar 🗑️</button>
                                </form>
                                <br>
                                <form action="actions.php" method="post">
                                    <input type="hidden" class="form-control" name="accion" value="reabrir">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $incidencia["id"]; ?>">
                                    <button type="submit" class="btn btn-success">Reabrir ♻️</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</body>

</html>