<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Libs/functions.php';
include __DIR__ . "/../Views/_header.php";
include __DIR__ . "/../Views/_navbar.php";



$search_term = isset($_GET['search_term']) ? $_GET['search_term'] : '';


$products = searchProducts($search_term);

echo "<div class='container mt-4'>";
echo    "<div class='row'>";

if (!empty($products)) {
    foreach ($products as $product) {
?>
        <style>
            .product-img {
                width: 100%;
                height: 200px;
                object-fit: cover;
            }
        </style>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="<?php echo $product['image']; ?>" class="card-img-top product-img" alt="<?php echo $product['name']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                    <p class="card-text"><?php echo $product['description']; ?></p>
                    <p class="card-text"><strong>Price: </strong><?php echo $product['price']; ?></p>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "<div class='col-md-12'><p>Ürün bulunamadı.</p></div>";
}
?>


<?php include __DIR__ . "/../Views/_scripts.php" ; ?>
<?php include __DIR__ . "/../Views/_footer.php"; ?>