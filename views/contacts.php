<?php
session_start();
require_once('../controllers/UserController.php');
require_once('../controllers/ContactController.php');

$userController = new UserController();

if (isset($_GET['cerrar_sesion'])) {
  $userController->cerrarSesion();
}

if (isset($_POST['contact_us'])) {

  $username = $_POST['username'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  $contactController = new ContactController();
  $result = $contactController->agregarContacto($username, $email, $message);

  echo $result;
}
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <title>Contacts</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" type="text/css"
    href="//fonts.googleapis.com/css?family=Poppins:300,300i,400,500,600,700,800,900,900i%7CPT+Serif:400,700" />
  <link rel="stylesheet" href="../css/bootstrap.css" />
  <link rel="stylesheet" href="../css/fonts.css" />
  <link rel="stylesheet" href="../css/style.css" />
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
                    <li class="rd-nav-item">
                      <a class="rd-nav-link" href="blogs.php">Blogs</a>
                    </li>
                    <?php
                    if (isset($_SESSION['username'])) {
                      echo '<li class="rd-nav-item">
                      <a class="rd-nav-link" href="administar.php">Administrar</a>
                    </li>';
                    } else {
                    }
                    ?>

                    <li class="rd-nav-item active">
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
              <h2 class="breadcrumbs-custom-title">Contactame</h2>
              <ul class="breadcrumbs-custom-path">
                <li><a href="index.html">Home</a></li>
                <li class="active">Contactame</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section section-lg text-center bg-default">
      <div class="container">
        <div class="row row-50">
          <div class="col-md-6 col-lg-4">
            <div class="box-icon-classic">
              <div class="box-icon-inner decorate-triangle">
                <span class="icon-xl linearicons-phone-incoming"></span>
              </div>
              <div class="box-icon-caption">
                <h4><a href="tel:#">3053804049</a></h4>
                <h4><a href="tel:#">3135579972</a></h4>
                <p>Puedes llamarme en cualquier momento</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="box-icon-classic">
              <div class="box-icon-inner decorate-circle">
                <span class="icon-xl linearicons-map2"></span>
              </div>
              <div class="box-icon-caption">
                <h4>
                  <a href="#">Carrera 13b #11A-19</a>
                </h4>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="box-icon-classic">
              <div class="box-icon-inner decorate-rectangle">
                <span class="icon-xl linearicons-paper-plane"></span>
              </div>
              <div class="box-icon-caption">
                <h4><a href="mailto:#">sierrajoseph8023@gmail.com</a></h4>
                <p>Estoy siempre atento a los emails</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Contact us-->
    <section class="section section-lg bg-gray-1 text-center">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-md-9 col-lg-7">
            <h3>Get in Touch</h3>
            <!-- RD Mailform-->
            <form class="rd-form rd-mailform" data-form-output="form-output-global" data-form-type="contact"
              method="post" action="#">
              <div class="form-wrap">
                <input class="form-input" id="contact-name" type="text" name="username" data-constraints="@Required"
                  value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" />
                <label class="form-label" for="contact-name" required>
                  Nombre de usuario
                </label>
              </div>
              <div class="form-wrap">
                <input class="form-input" id="contact-email" type="email" name="email"
                  data-constraints="@Email @Required" />
                <label class="form-label" for="contact-email" required>E-mail</label>
              </div>
              <div class="form-wrap">
                <label class="form-label" for="contact-message">
                  ¿Qué tienes para decirnos?</label>
                <textarea class="form-input" id="contact-message" name="message"
                  data-constraints="@Required"></textarea>
              </div>
              <div class="row justify-content-center">
                <div class="col-12 col-sm-7 col-lg-5">
                  <button class="button button-block button-lg button-primary" name="contact_us" type="submit"
                    value="Enviar">
                    Envíar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
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
  <script src="../js/core.min.js"></script>
  <script src="../js/script.js"></script>
</body>

</html>