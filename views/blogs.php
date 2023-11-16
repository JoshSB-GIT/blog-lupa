<?php
$username = '';
session_start();
require_once('../controllers/UserController.php');
require_once('../controllers/BlogEntryController.php');

$userController = new UserController();
$blogController = new BlogController();

if (isset($_GET['cerrar_sesion'])) {
  $userController->cerrarSesion();
}

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
}

if (isset($_POST['blogEntryId'])) {
  $blogEntryId = $_POST['blogEntryId'];
  $eliminada = $blogController->eliminarEntrada($blogEntryId);

  if ($eliminada) {
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Entrada eliminada correctamente.',
                showConfirmButton: false,
                timer: 1500
            });
          </script>";
  } else {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error al eliminar la entrada.',
                showConfirmButton: false,
                timer: 1500
            });
          </script>";
  }
}
$blogController->procesarFormulario($username);


?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <title>About Us</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" type="text/css"
    href="//fonts.googleapis.com/css?family=Poppins:300,300i,400,500,600,700,800,900,900i%7CPT+Serif:400,700" />
  <link rel="stylesheet" href="../css/bootstrap.css" />
  <link rel="stylesheet" href="../css/fonts.css" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <style>
    .ie-panel {
      display: none;
      background: #212121;
      padding: 10px 0;
      box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, 0.3);
      clear: both;
      text-align: center;
      position: relative;
      z-index: 1;
    }

    html.ie-10 .ie-panel,
    html.lt-ie-10 .ie-panel {
      display: block;
    }
  </style>
</head>

<body>
  <div class="ie-panel">
    <a href="http://windows.microsoft.com/en-US/internet-explorer/"><img
        src="../images/ie8-panel/warning_bar_0000_us.jpg" height="42" width="820"
        alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." /></a>
  </div>
  <div class="preloader">
    <div class="preloader-body">
      <div class="cssload-container">
        <div class="cssload-speeding-wheel"></div>
      </div>
      <p>Loading...</p>
    </div>
  </div>
  <div class="page">
    <!-- Page Header-->
    <header class="section page-header">
      <!-- RD Navbar-->
      <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
          data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static"
          data-lg-device-layout="rd-navbar-static" data-xl-layout="rd-navbar-static"
          data-xl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px"
          data-xxl-stick-up-offset="46px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
          <div class="rd-navbar-main-outer">
            <div class="rd-navbar-main">
              <!-- RD Navbar Panel-->
              <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap">
                  <span></span>
                </button>
                <!-- RD Navbar Brand-->
                <div class="rd-navbar-brand">
                  <!-- <a href="index.html"><img class="brand-logo-light" src="" alt=""
                      width="140" height="57" srcset="../images/logo-default-280x113.png 2x" /></a> -->
                </div>
              </div>
              <div class="rd-navbar-main-element">
                <div class="rd-navbar-nav-wrap">
                  <!-- RD Navbar Nav-->
                  <ul class="rd-navbar-nav">
                    <li class="rd-nav-item">
                      <a class="rd-nav-link" href="index.php">Home</a>
                    </li>
                    <li class="rd-nav-item active">
                      <a class="rd-nav-link" href="blogs.php">Blogs</a>
                    </li>
                    <?php
                    if (isset($_SESSION['username'])) {
                      echo '<li class="rd-nav-item">
                      <a class="rd-nav-link" href="administrar.php">Administrar</a>
                    </li>';
                    } else {
                    }
                    ?>

                    <li class="rd-nav-item">
                      <a class="rd-nav-link" href="contacts.php">Contacts</a>
                    </li>
                  </ul>
                </div>
              </div>
              <?php
              if (isset($_SESSION['username'])) {
                // Si la sesión está iniciada, muestra el enlace de "Cerrar sesión"
                echo '<a class="button button-white button-sm" href="?cerrar_sesion=true">Cerrar sesión</a>';
              } else {
                // Si la sesión no está iniciada, muestra el enlace de "Iniciar sesión"
                echo '<a class="button button-white button-sm" href="login.php">Iniciar sesión</a>';
              }
              ?>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <section class="parallax-container overlay-1" data-parallax-img="../images/nature-minimalist-style-081.jpg">
      <div class="parallax-content breadcrumbs-custom context-dark">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12 col-lg-9">
              <h2 class="breadcrumbs-custom-title">¿Quieres leer algo?</h2>
              <ul class="breadcrumbs-custom-path">
                <li><a href="index.html">Home</a></li>
                <li class="active">¿Quieres leer algo?</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section section-lg bg-gray-1">
      <div class="container">
        <?php

        $entradas = $blogController->cargarTodasEntradas();

        if ($entradas) {
          foreach ($entradas as $entrada) {
            $contenidoCorto = strlen($entrada['content']) > 200 ? substr($entrada['content'], 0, 200) . '...' : $entrada['content'];
            echo "<a href='ver_completo.php?id=" . $entrada['blog_entrie_id'] . "'><div class='row row-50 mb-4'>
            <div class='col-lg-6 pr-xl-5'>
              <img src='" . $entrada["image_path"] . "' alt='' width='518' height='434' />
            </div>
            <div class='col-lg-6'>
              <h2>" . $entrada["title"] . "</h2>
              <div class='text-with-divider'>
                <div class='divider'></div>
                <h4>
                 " . $entrada["username"] . "
                </h4>
              </div>
              <p>
              " . $contenidoCorto . "
              </p>
              <p>
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                accusantium doloremque laudantium, totam rem aperiam, eaque ipsa
                quae ab illo inventore veritatis et quasi architecto beatae
                vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia
                voluptas sit aspernatur aut odit aut fugit, sed quia
                consequuntur
              </p>
            </div>
          </div></a>";
          }
        }
        ?>
      </div>
    </section>
    <!-- Page Footer-->
    <footer class="section footer-minimal context-dark">
      <div class="container wow-outer">
        <div class="wow fadeIn">
          <div class="row row-60">
            <div class="col-12">
              <a href="index.html"><img src="" alt="" width="140" height="57"
                  srcset="../images/logo-default-280x113.png 2x" /></a>
            </div>
            <div class="col-12">
              <ul class="footer-minimal-nav">
                <li><a href="#">Menu</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="contacts.html">Contacts</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="about-us.html">About</a></li>
              </ul>
            </div>
            <div class="col-12">
              <ul class="social-list">
                <li>
                  <a class="icon icon-sm icon-circle icon-circle-md icon-bg-white fa-facebook" href="#"></a>
                </li>
                <li>
                  <a class="icon icon-sm icon-circle icon-circle-md icon-bg-white fa-instagram" href="#"></a>
                </li>
                <li>
                  <a class="icon icon-sm icon-circle icon-circle-md icon-bg-white fa-twitter" href="#"></a>
                </li>
                <li>
                  <a class="icon icon-sm icon-circle icon-circle-md icon-bg-white fa-youtube-play" href="#"></a>
                </li>
                <li>
                  <a class="icon icon-sm icon-circle icon-circle-md icon-bg-white fa-pinterest-p" href="#"></a>
                </li>
              </ul>
            </div>
          </div>
          <p class="rights">
            <span>&copy;&nbsp; </span><span
              class="copyright-year"></span><span>&nbsp;</span><span>Pesto</span><span>.&nbsp;</span><span>All Rights
              Reserved.</span><span>&nbsp;</span><a href="#">Privacy Policy</a>. Design&nbsp;by&nbsp;<a
              href="https://www.templatemonster.com">Templatemonster</a>
          </p>
        </div>
      </div>
    </footer>
  </div>
  <div class="snackbars" id="form-output-global"></div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../js/core.min.js"></script>
  <script src="../js/script.js"></script>
</body>

</html>