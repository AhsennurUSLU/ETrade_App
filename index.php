<?php include "config.php"  ?>
<?php require "Libs/functions.php"  ?>



<?php require "Views/_header.php"  ?>
<?php require "Views/_navbar.php"  ?>


<div class="container my-5">
    <div class="row">

        <div class="col-3">
            <!-- <?php include "Views/_sidebar.php"  ?> -->
        </div>

        <?php include "MainContent/_mainSlider.php"; ?>
        <div class="col-9">


        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <?php include "MainContent/_brandSlider.php"; ?>
    <br>
    <br>
    <br>
    <br>
    <?php include "MainContent/_interestedCategories.php"; ?>
</div>



<?php include "Views/_scripts.php"  ?>

<?php include "Views/_footer.php"  ?>
</body>

</html>