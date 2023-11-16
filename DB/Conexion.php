<?php

require_once(__DIR__ . '/../config/config.php');

class ConexionMySQL
{
    private $host;
    private $usuario;
    private $clave;
    private $baseDeDatos;
    private $conexion;

    public function __construct()
    {
        $this->host = DB_HOST;
        $this->usuario = DB_USER;
        $this->clave = DB_PASSWORD;
        $this->baseDeDatos = DB_NAME;

        $this->conectar();
    }

    private function conectar()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->baseDeDatos}";
            $opciones = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
            ];

            $this->conexion = new PDO($dsn, $this->usuario, $this->clave, $opciones);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function executeQuery($consulta, $parametros = [])
    {
        try {
            $stmt = $this->conexion->prepare($consulta);
            $stmt->execute($parametros);
            return $stmt;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }

    public function cerrarConexion()
    {
        $this->conexion = null;
    }
}
?>