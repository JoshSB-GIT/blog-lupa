<?php
require_once(__DIR__ . '/../models/UserModel.php');


class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function listarUsuarios()
    {
        $usuarios = $this->userModel->obtenerUsuarios();
        foreach ($usuarios as $usuario) {
            echo "Nombre: {$usuario['nombre']}, Email: {$usuario['email']}<br>";
        }
    }

    public function agregarUsuario($nombre, $contrasena)
    {
        try {
            $this->userModel->agregarUsuario($nombre, $contrasena);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function iniciarSesion($username, $password)
    {
        $message = null;
        $storedHashedPassword = $this->userModel->obtenerHashContraseña($username);

        if ($storedHashedPassword) {
            if (password_verify($password, $storedHashedPassword)) {
                session_start();
                $_SESSION['username'] = $username;
                $message = "Inicio de sesión exitoso. ¡Bienvenido, $username!";
                header("Location: ../views/index.php");
            } else {
                $message = null;
            }
        } else {
            $message = null;
        }
        return $message;
    }

    public function cerrarSesion()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = array();

        session_destroy();

        header("Location: index.php");
        exit();
    }
}
?>