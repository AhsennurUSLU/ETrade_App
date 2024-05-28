<?php include "../config.php"  ?>
<?php require "../Libs/variables.php"; ?>



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

        <?php foreach ($categories as $category) : ?>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="<?php echo $category['imageUrl']; ?>" class="card-img-top" alt="<?php echo $category['categoryName']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $category['categoryName']; ?></h5>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php echo count($categories) . " kategori listelenmiştir."; ?>
    </div>
</div>


<?php include "../Views/_scripts.php"  ?>

<?php include "../Views/_footer.php"; ?>