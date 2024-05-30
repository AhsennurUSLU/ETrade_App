<?php

require_once __DIR__ . '/../Libs/functions.php';

?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">

        <a class="navbar-brand" href="#">E-Trade </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>index.php">Anasayfa </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>Main/Pages/About.php">Hakkımızda</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>index.php">Yardım</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>Main/Pages/Categories.php">Kategoriler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>Main/Pages/MyCart.php">Sepetim</a>
                </li>

            </ul>

            <ul class="navbar-nav mb-2 mb-lg-0">

                <?php if (isLoggedin()) : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Hoş geldiniz, <?php echo $_SESSION["email"] ?></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Profilim
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="<?php echo BASE_URL; ?>Main/Pages/Logout.php" class="nav-link">Çıkış Yap</a>
                            <a href="<?php echo BASE_URL; ?>Main/Pages/MyProfile.php" class="nav-link">Profilim</a>
                        </div>
                    </li>
                <?php else : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hesap
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo BASE_URL; ?>Main/Pages/Register.php">Kayıt Ol</a>
                            <a class="dropdown-item" href="<?php echo BASE_URL; ?>Main/Pages/Login.php">Giriş Yap</a>
                        </div>
                    </li>
                <?php endif; ?>



            </ul>




            <form class="d-flex" method="GET">
                <input class="form-control me-4" type="search" placeholder="Aradığınız ürün, kategori, marka " aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ara</button>
            </form>






        </div>








    </div>
</nav>