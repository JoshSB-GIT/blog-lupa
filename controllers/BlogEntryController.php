<?php

require_once __DIR__ . '/../models/BlogEntryModel.php';
require_once __DIR__ . '/../models/UserModel.php';

class BlogController
{
    private $blogEntryModel;
    private $userModel;
    private $userId;

    public function __construct()
    {
        $this->blogEntryModel = new BlogEntryModel();
        $this->userModel = new UserModel();
    }

    public function procesarFormulario($user)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subir'])) {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $file = $_FILES['file'];

            if (empty($title) || empty($content) || empty($file['name'])) {
                echo "Por favor, complete todos los campos.";
                return;
            }
            $imagePath = $this->subirImagen($file);
            if ($imagePath) {
                $usuarios = $this->userModel->obtenerUsuarios("WHERE username = '" . $user . "'");
                $this->userId = !empty($usuarios) ? $usuarios[0]['user_id'] : null;

                $agregada = $this->blogEntryModel->agregarEntrada(
                    $this->userId,
                    $title,
                    $content,
                    $imagePath
                );

                if ($agregada) {
                    echo "Entrada agregada correctamente.";
                } else {
                    echo "Error al agregar la entrada.";
                }
            } else {
                echo "Error al subir la imagen.";
            }
        }
    }

    public function subirImagen($file)
    {
        $targetDir = "../images/";
        $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

        $uniqueName = uniqid() . '.' . $imageFileType;
        $targetFile = $targetDir . $uniqueName;
        $uploadOk = 1;


        if ($file["size"] > 500000000) {
            echo "El archivo es demasiado grande.";
            $uploadOk = 0;
        }
        if ($uploadOk == 1) {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return $targetFile;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function cargarEntradas($username)
    {
        $entradas = $this->blogEntryModel->obtenerEntradaPorUser($username);
        return $entradas;
    }

    public function cargarTodasEntradas()
    {
        $entradas = $this->blogEntryModel->obtenerEntradas();
        return $entradas;
    }

    public function obtenerEntradaPorId($id)
    {
        $entradas = $this->blogEntryModel->obtenerEntradaPorId($id);
        return $entradas;
    }

    public function actualizarEntrada($blogEntryId, $title, $content, $imagePath)
    {
        $actualizada = $this->blogEntryModel->actualizarEntrada($blogEntryId, $title, $content, $imagePath);

        return $actualizada;
    }

    public function eliminarEntrada($blogEntryId)
    {
        $eliminada = $this->blogEntryModel->eliminarEntrada($blogEntryId);
        return $eliminada;
    }

}

?>