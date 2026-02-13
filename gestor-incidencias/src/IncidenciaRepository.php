<?php

require_once "../config/database.php";

class IncidenciaRepository
{
    /**
     * Devuelve true si todo sale bien o un string con el error si algo falla
     * hace una consulta sql a la bd y devuelve un array con los resultados
     *
     * @return array con los datos de la consulta
     * @return string si ocurre algún error
     */
    public function findAll(): array | string
    {
        $conn = getConnection();
        $consulta = "SELECT * FROM incidencias";
        $stmt = $conn->prepare($consulta);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return "Error al recuperar las incidencias, error: " . $ex->getMessage();
        }
    }

    /**
     * Devuelve true si todo sale bien o un string con el error si algo falla
     * hace un insert en la db incidencias  con los datos que se le pasan por parametro
     *
     * @return true si todo sale bien
     * @return string si ocurre algún error
     */
    public function crearIncidencia($titulo, $descripcion, $estado): bool | string
    {
        $conn = getConnection();
        $query = "INSERT INTO incidencias (titulo, descripcion, estado) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute([$titulo, $descripcion, $estado]);
            return true;
        } catch (PDOException $ex) {
            return "Error al crear nueva incidencia, error: " . $ex->getMessage();
        }
    }

    /**
     * Devuelve true si todo sale bien o un string con el error si algo falla
     * hace un update en la bd, modifica el campo estado del id pasado por parametro a "cerrada"
     *
     * @return true si todo sale bien
     * @return string si ocurre algún error
     */
    public function cerrarIncidencia($id): bool|string {
        $conn = getConnection();
        $query = "UPDATE incidencias SET estado = 'Cerrada' WHERE id = ?";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $ex) {
            return "Error al cerrar incidencia , error: ". $ex->getMessage();
        }
    }

    /**
     * Devuelve true si todo sale bien o un string con el error si algo falla
     * hace un update en la bd, modifica el campo estado del id pasado por parametro a "Abierta"
     *
     * @return true si todo sale bien
     * @return string si ocurre algún error
     */
    public function reabrirIncidencia($id): bool|string {
        $conn = getConnection();
        $query = "UPDATE incidencias SET estado = 'Abierta' WHERE id = ?";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $ex) {
            return "Error al cerrar incidencia , error: ". $ex->getMessage();
        }
    }

    /**
     * Devuelve true si todo sale bien o un string con el error si algo falla
     * Elimina la incidencia que coincide con el valor pasado como parametro
     *
     * @return true si todo sale bien
     * @return string si ocurre algún error
     */
    public function eliminarIncidencia($id): bool|string {
        $conn = getConnection();
        $query = "DELETE FROM incidencias WHERE id = ?";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $ex) {
            return "Error al eliminar incidencia, error: ". $ex->getMessage();
        }
    }
}
