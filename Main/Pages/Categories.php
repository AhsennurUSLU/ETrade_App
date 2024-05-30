<?php include "../../config.php"  ?>


<?php
include "../Libs/connect.php";

$sql = "SELECT * FROM categories";
$result = mysqli_query($connection, $sql);


?>

<style>
    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>


<?php require "../Views/_header.php";  ?>
<?php require "../Views/_navbar.php";  ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-3">
            <h3>Kategoriler</h3>

        </div>
        <div class="col-9">
            <form class="d-flex">
                <input class="form-control me-4" type="search" placeholder="Aradığınız ürün, kategori, markayı yazınız. " aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Ara</button>
            </form>
        </div>
    </div>
    <div class="row">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $image =  $row['image'];
                $name = $row['name'];
                echo "<div class='col-md-3 mb-4'>";
                echo  "  <div class='card'>";
                echo       "<img src='$image' class='card-img-top' alt='$name'>";
                echo       "<div class='card-body'>";
                echo          "<h5 class='card-title'>$name</h5>";
                echo      "</div>";
                echo    "</div>";
                echo   "</div>";
            }
        } else {
            echo "<tr><td colspan='7'>Kategori bulunamadı.</td></tr>";
        }
        ?>



    </div>
 
</div>


<?php include "../Views/_scripts.php"  ?>

<?php include "../Views/_footer.php"; ?>