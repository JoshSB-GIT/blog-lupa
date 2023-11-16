<?php

require_once(__DIR__ . '/../DB/Conexion.php');

class BlogEntryModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new ConexionMySQL();
    }

    public function obtenerEntradas()
    {
        $consulta = "SELECT be.title, be.image_path, be.content, 
        u.username, be.created_at, u.user_id, be.blog_entrie_id
            FROM blog_entries as be 
        INNER JOIN users as u 
            ON be.user_id = u.user_id";
        $resultado = $this->conexion->executeQuery($consulta);

        $entradas = [];
        while ($fila = $resultado->fetch()) {
            $entradas[] = $fila;
        }

        return $entradas;
    }

    public function obtenerEntradaPorId($blogEntryId)
    {
        $consulta = "SELECT be.title, be.image_path, be.content, 
        u.username, be.created_at, u.user_id, be.blog_entrie_id
            FROM blog_entries as be 
        INNER JOIN users as u 
            ON be.user_id = u.user_id 
        WHERE be.blog_entrie_id = '" . $blogEntryId . "'";

        $resultado = $this->conexion->executeQuery($consulta);

        $entradas = [];
        while ($fila = $resultado->fetch()) {
            $entradas[] = $fila;
        }

        return $entradas;
    }

    public function obtenerEntradaPorUser($username)
    {
        $consulta = "SELECT be.title, be.image_path, be.content, 
        u.username, be.created_at, u.user_id, be.blog_entrie_id
            FROM blog_entries as be 
        INNER JOIN users as u 
            ON be.user_id = u.user_id 
        WHERE u.username = '" . $username . "'";

        $resultado = $this->conexion->executeQuery($consulta);

        $entradas = [];
        while ($fila = $resultado->fetch()) {
            $entradas[] = $fila;
        }

        return $entradas;
    }

    public function agregarEntrada($userId, $title, $content, $imagePath)
    {
        try {
            $consulta = "INSERT INTO blog_entries (user_id, title, content, image_path) VALUES (:userId, :title, :content, :imagePath)";

            $parametros = [
                ':userId' => $userId,
                ':title' => $title,
                ':content' => $content,
                ':imagePath' => $imagePath,
            ];

            $this->conexion->executeQuery($consulta, $parametros);
            return true;
        } catch (Exception $e) {
            return false;
        }

    }

    public function actualizarEntrada($blogEntryId, $title, $content, $imagePath)
    {
        $consulta = "UPDATE blog_entries SET title = :title, content = :content, image_path = :imagePath WHERE blog_entrie_id = :id";

        $parametros = [
            ':id' => $blogEntryId,
            ':title' => $title,
            ':content' => $content,
            ':imagePath' => $imagePath,
        ];

        try {
            $this->conexion->executeQuery($consulta, $parametros);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function eliminarEntrada($blogEntryId)
    {
        $consulta = "DELETE FROM blog_entries WHERE blog_entrie_id = :id";
        $parametros = [':id' => $blogEntryId];

        try {
            $this->conexion->executeQuery($consulta, $parametros);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>