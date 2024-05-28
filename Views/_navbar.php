

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">

        <a class="navbar-brand" href="#">A-Trade App</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>">Anasayfa </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>Pages/About.php">Hakkımızda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>Pages/MyCart.php">Sepetim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>">Yardım</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>Pages/Categories.php">Kategoriler</a>
                </li>
            </ul>

            <ul class="navbar-nav mb-2 mb-lg-0">

               
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Hoş geldiniz</a>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hesap
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>Pages/Register.php">Kayıt Ol</a>
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>Pages/Login.php">Giriş Yap</a>
                    </div>
                </li>
                    <li class="nav-item">
                        <a href="<?php echo BASE_URL; ?>Pages/MyProfile.php" class="nav-link">Profilim</a>
                    </li>


            </ul>




            <form class="d-flex">
                <input class="form-control me-4" type="search" placeholder="Aradığınız ürün, kategori, marka " aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ara</button>
            </form>






        </div>








    </div>
</nav>