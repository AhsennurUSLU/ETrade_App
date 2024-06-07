
<?php require_once __DIR__ . "/config.php"; ?>
<?php require_once __DIR__ . "/Main/Libs/functions.php"  ?>



<?php include __DIR__ . "/Main/Views/_header.php"  ?>
<?php include __DIR__ . "/Main/Views/_navbar.php"  ?>


<div class="container my-5">
    <div class="row">

       

        <?php include __DIR__ . "/Main/MainContent/_mainSlider.php"; ?>
        
    </div>
    <br>
    <br>
    <br>
    <br>
    <?php include __DIR__ . "/Main/MainContent/_mainContent.php"; ?>
    <br>
    <br>
    <br>
    <br>
    <?php include __DIR__ . "/Main/MainContent/_interestedCategories.php"; ?>
    <br>
    <br>
    <br>
    <br>
    <?php include __DIR__ . "/Main/MainContent/_brandSlider.php"; ?>
    <br>
    <br>
    <br>
    <br>
    <?php include __DIR__ . "/Main/MainContent/_populer.php"; ?>
</div>



<?php include __DIR__ . "/Main/Views/_scripts.php"  ?>

<?php include __DIR__ . "/Main/Views/_footer.php"  ?>
</body>

</html>