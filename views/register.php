<?php
$result = 'mjhgf';
session_start();
if (isset($_SESSION['username'])) {
  header('Location: index.php');
  exit();
}

require_once('../controllers/UserController.php');
if (isset($_POST['register'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  $userController = new UserController();
  $result = $userController->agregarUsuario($username, $password);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="../css/login.css" />
  <title>Registrarse</title>
</head>

<body>
  <form class="login" method="POST" action="#">
    <h2>Register</h2>
    <input type="text" placeholder="Username" name="username" required />
    <input type="password" placeholder="Password" name="password" required />
    <button type="submit" name="register" value="Registrar">Register</button>
    
    <a href="login.php" class="a-ti">Login</a>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php
  if (isset($result) && $result != null) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Bienvenido',
                text: '{$result}'
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = 'index.php';
            });
            </script>";
  } else {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error al iniciar sesion',
                text: 'Usuario o conraseña incorrecta',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                
            });
            </script>";
  }
  ?>
</body>

</html>