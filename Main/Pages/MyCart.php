<?php include __DIR__ . "/../../config.php" ; ?>
<?php include __DIR__ . "/../Views/_header.php" ; ?>
<?php include __DIR__ . "/../Views/_navbar.php" ; ?>
<?php include __DIR__ . "/../Libs/connect.php"; ?>
<?php


if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $product_ids = array_keys($_SESSION['cart']);
    $product_ids_string = implode(',', $product_ids);

    $query = "SELECT * FROM products WHERE id IN ($product_ids_string)";
    $result = mysqli_query($connection, $query);
} 

?>



<div class="container mt-5">
    <h1 class="mb-4">Sepetim</h1>

    <?php
    if (isset($result) && mysqli_num_rows($result) > 0) {
        echo   "<table class='table table-bordered'>";
        echo    "<thead>";
        echo       "<tr>";
        echo           "<th>Ürün Adı</th>";
        echo          "<th>Fiyat</th>";
        echo         "<th>Miktar</th>";
        echo         "<th>Toplam</th>";
        echo        "<th>İşlem</th>";
        echo   "</tr>";
        echo "</thead>";
        echo "<tbody>";



        $total_price = 0;

        while ($row = mysqli_fetch_assoc($result)) {

            $product_id = $row['id'];
            $product_name = $row['name'];
            $product_price = $row['price'];
            $product_quantity = $_SESSION['cart'][$product_id];
            $total_product_price = $product_price * $product_quantity;
            $total_price += $total_product_price;
       

        echo "<tr>";
        echo "<td>$product_name</td>";
        echo "<td>$product_price TL</td>";
        echo "<td>$product_quantity</td>";
        echo "<td>$total_product_price TL</td>";
        echo "<td><a href='cart.php?action=remove&product_id=$product_id' class='btn btn-sm' style='background-color: #6D2932; color:white;' >Sil</a></td>";
        echo "</tr>";

    }



        echo "</tbody>";
        echo "</table>";
        echo "<div class='text-right'>";
        echo "<h4>Genel Toplam:  $total_price TL</h4>";
        echo "<a href='cart.php?action=clear' class='btn' style='background-color: #3C5B6F; color:white;'>Sepeti Boşalt</a>";
        echo "<a href='checkout.php' class='btn' style='background-color: #153448; color:white;'>Satın Al</a>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-info'>Sepetinizde ürün bulunmamaktadır.</div>";
    }

mysqli_close($connection);
       ?>
    <a href="Categories.php" class="btn  mt-3" style="background-color: #3C5B6F; color:white;">Alışverişe Devam Et</a>
    </div>
    

    <?php include __DIR__ . "/../Views/_scripts.php"  ?>
    <?php include __DIR__ . "/../Views/_footer.php"; ?>