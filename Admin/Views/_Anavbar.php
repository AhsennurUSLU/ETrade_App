
<style>

.navbar {
    background-color: #333;
    overflow: hidden;
    position: relative;
    top: 0;
    width: calc(100% - 250px); 
    left: 200px; 
}


</style>



<nav class="navbar navbar-expand-lg navbar-dark bg-dark ml-5">
    <div class="container">

        <a class="navbar-brand" href="#">A-Trade App Yönetim Paneli</a>

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








        </div>
