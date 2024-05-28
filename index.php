<?php require "config.php"  ?>
<?php require "Views/_header.php"  ?>
<?php require "Views/_navbar.php"  ?>


<div class="container my-5">
    <div class="row">

        <div class="col-3">
            <?php include "Views/_sidebar.php"  ?>
        </div>

        <div class="col-9">

            <?php include "Views/_content.php"; ?>
          

        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <?php include "Pages/Index-brand-slider.php"; ?>
    <br>
    <br>
    <br>
    <br>
    <h2>Bunlar da İlginizi Çekebilir</h2>
    <div class="d-flex flex-wrap">
        <a href="#" class="btn btn-light  btn-pill m-2">Giyim</a>
        <a href="#" class="btn btn-light  btn-pill m-2">Kozmetik</a>
        <a href="#" class="btn btn-light  btn-pill m-2">Elektronik</a>
        <a href="#" class="btn btn-light  btn-pill m-2">Yiyecek</a>
        <a href="#" class="btn btn-light  btn-pill m-2">İçecek</a>
        <a href="#" class="btn btn-light  btn-pill m-2">Saat & Aksesuar</a>
        <a href="#" class="btn btn-light  btn-pill m-2">Kırtasiye</a>
        <a href="#" class="btn btn-light  btn-pill m-2">Kitap</a>
        <a href="#" class="btn btn-light  btn-pill m-2">Ev & Mobilya</a>
        <a href="#" class="btn btn-light  btn-pill m-2">Ayakkabı & Çanta</a>
        <a href="#" class="btn btn-light  btn-pill m-2">Spor & Outdoor</a>
        <a href="#" class="btn btn-light  btn-pill m-2">Anne & Çocuk</a>
    </div>
</div>









<?php include "Views/_scripts.php"  ?>

<?php include "Views/_footer.php"  ?>
</body>

</html>