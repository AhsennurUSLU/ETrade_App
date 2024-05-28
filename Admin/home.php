<?php require "Aconfig.php"  ?>
<?php include "Views/_Aheader.php" ?>

<div class="container-fluid position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    <?php include "Views/_Asidebar.php" ?>
    <div class="content">
        <?php include "Views/_Anavbar.php" ?>
        <?php include "Views/_Acontent.php" ?>
        <?php include "Views/_Afooter.php" ?>
    </div>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
<?php include "Views/_Ascripts.php" ?>