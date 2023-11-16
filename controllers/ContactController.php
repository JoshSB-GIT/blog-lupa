<?php
require_once(__DIR__ . '/../models/ContactModel.php');

class ContactController
{
    private $contactModel;

    public function __construct()
    {
        $this->contactModel = new ContactModel();
    }

    public function listarContactos()
    {
        $contactos = $this->contactModel->obtenerContactos();

        // Puedes hacer algo con la lista de contactos, como mostrarlos en una vista
        foreach ($contactos as $contacto) {
            echo "Nombre: {$contacto['nombre']}, Email: {$contacto['email']}, Mensaje: {$contacto['message']}<br>";
        }
    }

    public function agregarContacto($username, $email, $mensaje)
    {
        try {
            $this->contactModel->agregarContacto($username, $email, $mensaje);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>