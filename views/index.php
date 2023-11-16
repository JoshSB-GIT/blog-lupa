<?php
session_start();
require_once('../controllers/UserController.php');

$userController = new UserController();

if (isset($_GET['cerrar_sesion'])) {
  $userController->cerrarSesion();
}
?>


<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <title>Home</title>
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
                    <li class="rd-nav-item active">
                      <a class="rd-nav-link" href="index.php">Home</a>
                    </li>
                    <li class="rd-nav-item">
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
    <!-- Swiper-->
    <section class="section section-lg section-main-bunner section-main-bunner-filter text-center">
      <div class="main-bunner-img" style="
            background-image: url('../images/nature-minimalist-style-081.jpg');
            background-size: cover;
          "></div>
      <div class="main-bunner-inner">
        <div class="container">
          <div class="box-default">
            <h1 class="box-default-title">Bienvenido
              <?php if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                echo $username;
              } else {
              } ?>
            </h1>
            <div class="box-default-decor"></div>
            <p class="big box-default-text">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Numquam accusantium architecto nisi illo cum
              animi voluptates, mollitia vel, laboriosam eveniet maxime! Illo atque, non eveniet tempora voluptate
              commodi molestias quis.
            </p>
          </div>
        </div>
      </div>
    </section>
    <div class="bg-gray-1">
      <section class="section-transform-top">
        <div class="container">
          <div class="box-booking">
            <form class="rd-form rd-mailform booking-form">
              <div>
                <p class="booking-title">Name</p>
                <div class="form-wrap">
                  <input class="form-input" id="booking-name" type="text" name="name" data-constraints="@Required" />
                  <label class="form-label" for="booking-name">Your name</label>
                </div>
              </div>
              <div>
                <p class="booking-title">Phone</p>
                <div class="form-wrap">
                  <input class="form-input" id="booking-phone" type="text" name="phone" data-constraints="@Numeric" />
                  <label class="form-label" for="booking-phone">Your phone number</label>
                </div>
              </div>
              <div>
                <p class="booking-title">Date</p>
                <div class="form-wrap form-wrap-icon">
                  <span class="icon mdi mdi-calendar-text"></span>
                  <input class="form-input" id="booking-date" type="text" name="date" data-constraints="@Required"
                    data-time-picker="date" />
                </div>
              </div>
              <div>
                <p class="booking-title">no. of people</p>
                <div class="form-wrap">
                  <select data-placeholder="2">
                    <option label="placeholder"></option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                  </select>
                </div>
              </div>
              <div>
                <button class="button button-lg button-gray-600" type="submit">
                  Check availability
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <section class="section section-lg section-inset-1 bg-gray-1 pt-lg-0">
        <div class="container">
          <div class="row row-50 justify-content-xl-between align-items-lg-center">
            <div class="col-lg-6 wow fadeInLeft">
              <div class="box-image">
                <img class="box-image-static" src="../images/home-3-1-483x327.jpg" alt="" width="483"
                  height="327" /><img class="box-image-position" src="../images/home-3-2-341x391.png" alt="" width="341"
                  height="391" />
              </div>
            </div>
            <div class="col-lg-6 col-xl-5 wow fadeInRight">
              <h2>About Us</h2>
              <p>
                Pesto is a family owned and operated Italian Restaurant
                offering a combination of fresh ingredients and authentic
                Italian cooking.
              </p>
              <p>
                We will make sure you are served the most authentic and fresh
                Italian dishes, while offering the best customer service. Our
                kitchen is committed to providing our guests with the best
                Italian Cuisine.
              </p>
              <img src="../images/signature-1-140x50.png" alt="" width="140" height="50" />
            </div>
          </div>
        </div>
      </section>
    </div>
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