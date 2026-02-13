<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Nuevas Incidencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>Formulario Nuevas Incidencias</h1>

        <!-- formulario con 3 campos, todos obligatorios, estado es un campo de seleccion con dos posibilidades -->
        <form action="actions.php" method="post">
            <input type="hidden" class="form-control" name="accion" value="crear">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" minlength="3" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" minlength="3" required>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado Incidencia</label>
                <select class="form-select" id="estado" name="estado" required>
                    <option selected value="Abierta">Abierta</option>
                    <option value="Cerrada">Cerrada</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>

        </form>

        <br>
        <!-- boton para redireccionar al index.php -->
        <a href="index.php" class="btn btn-danger mb-3">Cancelar</a>

    </div>

</body>

</html>