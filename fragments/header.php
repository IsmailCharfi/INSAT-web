<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $title ?></title>


    <!-- ======= Favicons ======= -->
    <link href="assets/img/favicon.png" rel="icon">

    <!-- ======= Google Fonts ======= -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- ======= External CSS Files ======= -->
    <link href="assets/external/aos/aos.css" rel="stylesheet">
    <link href="assets/external/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/external/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <?php if (isset($homePage)){?>
    <link href="assets/external/swiper/swiper-bundle.min.css" rel="stylesheet">     
    <?php } ?>
    

    <!-- ======= Main CSS File ======= -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container-fluid d-flex align-items-center">
            <div class="logo me-auto">
                <a href="index.php"><img id="logo" src="./assets/img/favicon.png" /> <img src="./assets/img/logo_v4.jpg"></a>
            </div>
            <!-- ======= NavBar ======= -->
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto <?php if (isset($homePage)) echo "active" ?>" href="index.php#welcome">Acceuil</a></li>
                    <li><a class="nav-link scrollto" href="index.php#tabs">A propos</a></li>
                    <li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
                    <li class="dropdown"><a class="nav-link">Autres<i><iconify-icon data-icon="bi:chevron-down"></iconify-icon></i></a>
                        <ul>
                            <li><a class="nav-link" href="actualites.php">Les Actualités</a></li>
                            <li><a class="nav-link" href="emplois-du-temps.php">Emplois du temps</a></li>
                        </ul>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-btn"></i>
                <div id="mySidenav" class="sidenav">
                    <i class="closebtn"><iconify-icon data-icon="line-md:arrow-close-right"></iconify-icon></i>
                    <a class="nav-link scrollto <?php if (isset($homePage)) echo "active" ?>" href="index.php#welcome">Acceuil</a>
                    <a class="nav-link scrollto" href="index.php#tabs">A propos</a>
                    <a class="nav-link scrollto" href="index.php#contact">Contact</a>
                    <a href="actualites.php">Les Actualités</a>
                    <a href="emplois-du-temps.php">Emplois du temps</a>
                </div>
            </nav>
            <!-- ======= End Of NavBar ======= -->
            <a href="#" class="log-in-btn scrollto" data-bs-toggle="modal" data-bs-target="#LogInModal">Se connecter</a>
        </div>
    </header>

    <!--===== Log in Modal ====-->
    <div class="modal fade" id="LogInModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">
                    <h4 class="w-100 modal-title">
                        <img src="./assets/img/favicon.png" class="w-100 "> Connexion
                    </h4>
                </div>
                <div class="modal-body">
                    <form action="" method="Post">
                        <div class="mb-3 form-group">
                            <label for="mail-input" class="form-label">E-mail universitaire</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i><iconify-icon data-icon="fa:user"></iconify-icon></i></span>
                                <input id="mail-input" name="mail" type="email" class="form-control" placeholder="xyz@insat.u-carthage.tn" aria-describedby="basic-addon1" required>
                            </div>
                        </div>
                        <div class="mb-3 form-group">
                            <label for="password-input" class="form-label">Mot de passe</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon2">
                                <i><iconify-icon data-icon="fa:lock"></iconify-icon></i>
                            </span>
                                <input type="password" name="pwd" class="form-control" id="password-input" placeholder="xxxxx" required>
                            </div>
                        </div>
                        <button type="submit" class="btn log-in-btn mx-auto d-block" href="#">Se connecter</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#">Mot de passe oublié ?</a>
                </div>
            </div>
        </div>
    </div>

    <!-- ======= End Of Header ======= -->
