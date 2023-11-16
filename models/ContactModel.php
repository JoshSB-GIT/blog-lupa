<?php

require_once(__DIR__ . '/../DB/Conexion.php');

class ContactModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new ConexionMySQL();
    }

    public function obtenerContactos()
    {
        $consulta = "SELECT * FROM contacts";
        $resultado = $this->conexion->executeQuery($consulta);

        $contactos = [];
        while ($fila = $resultado->fetch()) {
            $contactos[] = $fila;
        }

        return $contactos;
    }

    public function agregarContacto($nombre, $email, $message)
    {
        $consulta = "INSERT INTO contacts (nombre, email, message) VALUES (:nombre, :email, :message)";

        $parametros = [
            ':nombre' => $nombre,
            ':email' => $email,
            ':message' => $message
        ];

        $this->conexion->executeQuery($consulta, $parametros);
    }
}

?>