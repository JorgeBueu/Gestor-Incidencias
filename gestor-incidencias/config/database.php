<?php

/**
 * Devuelve una conexión PDO a la base de datos
 * Lee los datos desde el archivo config.ini
 *
 * @return PDO  Objeto de conexión a la base de datos
 */
function getConnection(): PDO
{
    // Variable estática para reutilizar la misma conexión
    // durante toda la ejecución del script
    static $pdo = null;

    // Si la conexión ya existe, la devolvemos directamente
    if ($pdo !== null) {
        return $pdo;
    }

    try {
        // Leer el archivo config.ini y guardarlo en un array
        // El segundo parámetro (true) permite secciones como [database]
        $config = parse_ini_file("config.ini", true);

        // Comprobamos que el archivo se ha leído correctamente
        // y que existe la sección "database"
        if (!$config || !isset($config["database"])) {
            throw new Exception("No se pudo leer el archivo config.ini");
        }

        // Guardamos la sección [database] en una variable
        // para acceder más fácilmente a sus valores
        $db = $config["database"];

        // Construimos el DSN (Data Source Name)
        // Indica a PDO:
        // - el motor de base de datos (mysql)
        // - el servidor (host)
        // - la base de datos (dbname)
        // - el juego de caracteres (charset)
        $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8mb4";

        // Creamos el objeto PDO con:
        // - el DSN
        // - el usuario de la base de datos
        // - la contraseña
        $pdo = new PDO($dsn, $db['user'], $db['pass']);

        // Configuramos PDO para que lance excepciones
        // cuando ocurre un error (muy importante para depurar)
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Devolvemos la conexión creada
        return $pdo;

    } catch (PDOException $e) {
        // Errores específicos de PDO (conexión, credenciales, etc.)
        die("Error de conexión a la base de datos: " . $e->getMessage());
    } catch (Exception $e) {
        // Errores generales (config.ini inexistente o mal formado)
        die("Error de configuración: " . $e->getMessage());
    }
}