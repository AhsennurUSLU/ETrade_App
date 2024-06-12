<?php 
include __DIR__ . "/../../config.php"; 
include __DIR__ . "/../Libs/connect.php"; 
require __DIR__ . "/../Views/_header.php"; 
require __DIR__ . "/../Views/_navbar.php"; 

// Ürün ID'sini al
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Veritabanından ürünü al
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Ürün varsa detayları göster
    if ($row = mysqli_fetch_assoc($result)) {
?>
    <div class="containerA">
        <div class="product-image">
            <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
        </div>
        <div class="product-details">
            <div class="product-name"><?php echo $row['name']; ?></div>
            <div class="product-price">Fiyat: <?php echo $row['price']; ?> TL</div>
            <div class="product-description">
                <?php echo $row['description']; ?>
            </div>
            <div class="add-to-cart">
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <input type="number" name="quantity" value="1" min="1">
                    <button type="submit">Sepete Ekle</button>
                </form>
            </div>
        </div>
    </div>
<?php
    } else {
        echo "Ürün bulunamadı.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);
} else {
    echo "Ürün ID'si belirtilmedi.";
}
?>

<style>

.containerA {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin: 20px auto;
        max-width: 1000px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .product-image {
        width: 40%;
    }

    .product-details {
        width: 55%;
    }

    .product-name {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 20px;
        color: #3C5B6F;
        margin-bottom: 10px;
    }

    .product-description {
        font-size: 16px;
        line-height: 1.5;
    }

    .add-to-cart {
        margin-top: 20px;
    }

    .add-to-cart input[type="number"] {
        width: 60px;
    }

    .add-to-cart button {
        padding: 8px 15px;
        background-color: #3C5B6F;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }


</style>

<?php include __DIR__ . "/../Views/_scripts.php"; ?>
<?php include __DIR__ . "/../Views/_footer.php"; ?>
