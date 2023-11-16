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

$blogController->procesarFormulario($username);


?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <title>Ver completo</title>
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

<body style="background-color: #3a5a40">
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
                    data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed"
                    data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static"
                    data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static"
                    data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="46px"
                    data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
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
                                echo '<a class="button button-white button-sm" href="?cerrar_sesion=true">Cerrar sesión</a>';
                            } else {
                                echo '<a class="button button-white button-sm" href="login.php">Iniciar sesión</a>';
                            }
                            ?>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <section>
            <div class="container mt-5">
                <div class="row mt-5">
                    <?php
                    require_once('../controllers/BlogEntryController.php');

                    $blogController = new BlogController();
                    $entryId = $_GET['id'];
                    $entradas = $blogController->obtenerEntradaPorId($entryId);
                    if ($entradas) {
                        foreach ($entradas as $entrada) {
                            echo '<div class="col-md-12 my-5">';
                            echo '<div class="card shadow">';
                            echo '<img src="' . $entrada['image_path'] . '" class="card-img-top" alt="' . $entrada['title'] . '">';
                            echo '<div class="card-body">';
                            echo '<h2 class="card-title">' . $entrada['title'] . '</h2>';
                            echo '<h5 class="card-title">by: ' . $entrada['username'] . '</h5>';
                            echo '<p class="card-subtitle">' . $entrada['created_at'] . '</p>';
                            echo '<p class="card-text">' . $entrada['content'] . '</p>';
                            echo '</div></div></div>';
                        }
                    } else {
                        echo '<p>No hay entradas disponibles.</p>';
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
    <footer class="section footer-minimal context-dark">
        <div class="container wow-outer">
            <div class="wow fadeIn">
                <div class="row row-60">
                    <div class="col-12">
                        <a href="index.php"><img src="" alt="" width="140" height="57"
                                srcset="../images/logo-default-280x113.png 2x" /></a>
                    </div>
                    <div class="col-12">
                        <ul class="footer-minimal-nav">
                            <li><a href="#">Menu</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="contacts.php">Contacts</a></li>
                            <li><a href="#">Gallery</a></li>
                            <li><a href="about-us.php">About</a></li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <ul class="social-list">
                            <li>
                                <a class="icon icon-sm icon-circle icon-circle-md icon-bg-white fa-facebook"
                                    href="#"></a>
                            </li>
                            <li>
                                <a class="icon icon-sm icon-circle icon-circle-md icon-bg-white fa-instagram"
                                    href="#"></a>
                            </li>
                            <li>
                                <a class="icon icon-sm icon-circle icon-circle-md icon-bg-white fa-twitter"
                                    href="#"></a>
                            </li>
                            <li>
                                <a class="icon icon-sm icon-circle icon-circle-md icon-bg-white fa-youtube-play"
                                    href="#"></a>
                            </li>
                            <li>
                                <a class="icon icon-sm icon-circle icon-circle-md icon-bg-white fa-pinterest-p"
                                    href="#"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="rights">
                    <span>&copy;&nbsp; </span><span
                        class="copyright-year"></span><span>&nbsp;</span><span>Pesto</span><span>.&nbsp;</span><span>All
                        Rights
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