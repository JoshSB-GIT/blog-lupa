<?php

require_once(__DIR__ . '/../DB/Conexion.php');

class UserModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new ConexionMySQL();
    }

    public function obtenerUsuarios($where = '')
    {
        $consulta = "SELECT * FROM users " . $where;
        $resultado = $this->conexion->executeQuery($consulta);

        $usuarios = [];
        while ($fila = $resultado->fetch()) {
            $usuarios[] = $fila;
        }

        return $usuarios;
    }

    public function validarUsuario()
    {
        $consulta = "SELECT * FROM users";
        $resultado = $this->conexion->executeQuery($consulta);

        $usuarios = [];
        while ($fila = $resultado->fetch()) {
            $usuarios[] = $fila;
        }

        return $usuarios;
    }

    public function agregarUsuario($username, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $consulta = "INSERT INTO users (username, password) VALUES (:username, :password)";

        $parametros = [
            ':username' => $username,
            ':password' => $hashedPassword
        ];

        $this->conexion->executeQuery($consulta, $parametros);
    }

    public function obtenerHashContraseña($username)
    {
        $consulta = "SELECT password FROM users WHERE username = :username";
        $parametros = [':username' => $username];

        $resultado = $this->conexion->executeQuery($consulta, $parametros);

        $fila = $resultado->fetch();

        if ($fila) {
            return $fila['password'];
        } else {
            return null;
        }
    }


}
?>