<?php

require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Libs/functions.php';


?>

<style>
    .navbar-custom {
        background-color: #EEEEEE;
    }
</style>


<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <div class="container">

        <a class="navbar-brand" href="<?php echo BASE_URL; ?>index.php">E-Trade </a>

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



                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                            Sepetim
                            <?php
                            $cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
                            if ($cart_count > 0) {
                                echo "<span class='badge bg-secondary'>$cart_count</span>";
                            }
                            ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <?php
                            $yol =  BASE_URL . "Main/Pages/MyCart.php";
                            $yol2 =  BASE_URL . "Main/Libs/functions.php";
                            if ($cart_count > 0) {
                                foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                    $product = getProductById($product_id);
                                    if ($product) {
                                        $product_name = $product['name'];
                                        echo "<li><a class='dropdown-item' href='#'>$product_name <span class='badge bg-primary'>$quantity</span></a></li>";
                                    }
                                }
                                echo "<li><hr class='dropdown-divider'></li>";
                                echo "<li><a class='dropdown-item' href='$yol'>Sepete Git</a></li>";
                                echo "<form method='POST' action='$yol2'>";
                                echo  "<button type='submit' name='empty_cart' class='btn btn-light'>Sepeti Boşalt</button>";
                                echo  "</form>";
                            } else {
                                echo "<li><p class='dropdown-item-text'>Sepetinizde ürün bulunmamaktadır.</p></li>";
                            }
                            ?>
                        </ul>
                    </li>
                </ul>


                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>Main/Pages/Categories.php">Kategoriler</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>Main/Pages/Contact.php">İletişim</a>
                </li>

            </ul>

            <ul class="navbar-nav mb-2 mb-lg-0">

                <?php if (isLoggedin()) : ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Profilim
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="<?php echo BASE_URL; ?>Main/Pages/MyProfile.php" class="nav-link">Profilim</a>
                            <a href="<?php echo BASE_URL; ?>Main/Pages/Logout.php" class="nav-link">Çıkış Yap</a>

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


            <form class="d-flex" method="GET" action="<?php echo BASE_URL; ?>Main/Pages/search.php">
                <input class="form-control me-4" type="search" placeholder="Aradığınız ürün, kategori, marka " aria-label="Search" name="search_term">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search_term">Ara</button>
            </form>


        </div>



    </div>
</nav>