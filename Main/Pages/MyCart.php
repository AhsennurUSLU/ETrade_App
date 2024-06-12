<?php include __DIR__ . "/../../config.php"; ?>
<?php include __DIR__ . "/../Views/_header.php"; ?>
<?php include __DIR__ . "/../Views/_navbar.php"; ?>
<?php include __DIR__ . "/../Libs/connect.php"; ?>

<style>
    /* Buton stilini için CSS */
.quantity-minus, .quantity-plus {
    background-color: #6D2932;
    color: white;
    border: none;
    border-radius: 10px;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: bold;
    margin: 0 5px;
    transition: background-color 0.3s ease;
}

.quantity-minus:hover, .quantity-plus:hover {
    background-color: #9E3B43;
}

.quantity {
    width: 60px;
    border-radius: 5px;
    text-align: center;
}

</style>
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
        echo "<table class='table table-bordered'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Ürün Adı</th>";
        echo "<th>Fiyat</th>";
        echo "<th>Miktar</th>";
        echo "<th>Toplam</th>";
        echo "<th>İşlem</th>";
        echo "</tr>";
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
            echo "<td class='product-price' data-price='$product_price'>$product_price TL</td>";
            echo "<td>";
            echo "<div class='input-group'>";
            echo "<input type='text' class='quantity form-control text-center' value='$product_quantity' readonly>";
            echo "<button class='quantity-minus btn btn-sm mx-2'>-</button>";
            echo "<button class='quantity-plus btn btn-sm mx-2'>+</button>";
            echo "</div>";
            echo "</td>";
            echo "<td class='total-price'>$total_product_price TL</td>";
            echo "<td><a href='cart.php?action=remove&product_id=$product_id' class='btn btn-sm' style='background-color: #6D2932; color:white;'>Sil</a></td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "<div class='text-right'>";
        echo "<h4>Genel Toplam: <span class='total-price-summary'>$total_price TL</span></h4>";
        echo "<a href='cart.php?action=clear' class='btn' style='background-color: #3C5B6F; color:white;'>Sepeti Boşalt</a>";
        echo "<a href='Payment.php' class='btn' style='background-color: #153448; color:white;'>Satın Al</a>";
        echo "</div>";
    } else {
        echo "<div class='alert alert-info'>Sepetinizde ürün bulunmamaktadır.</div>";
    }

    mysqli_close($connection);
    ?>
    <a href="Categories.php" class="btn mt-3" style="background-color: #3C5B6F; color:white;">Alışverişe Devam Et</a>
</div>

<?php include __DIR__ . "/../Views/_scripts.php" ?>
<?php include __DIR__ . "/../Views/_footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.quantity-plus').click(function() {
            var $input = $(this).siblings('input.quantity');
            var currentValue = parseInt($input.val());
            $input.val(currentValue + 1);
            updatePrice($input);
        });

        $('.quantity-minus').click(function() {
            var $input = $(this).siblings('input.quantity');
            var currentValue = parseInt($input.val());
            if (currentValue > 1) {
                $input.val(currentValue - 1);
                updatePrice($input);
            }
        });

        function updatePrice($input) {
            var quantity = parseInt($input.val());
            var price = parseFloat($input.closest('tr').find('.product-price').data('price'));
            var totalPrice = quantity * price;
            $input.closest('tr').find('.total-price').text(totalPrice.toFixed(2) + ' TL');
            updateTotalPrice();
        }

        function updateTotalPrice() {
            var total = 0;
            $('.total-price').each(function() {
                total += parseFloat($(this).text().replace(' TL', ''));
            });
            $('.total-price-summary').text(total.toFixed(2) + ' TL');
        }
    });
</script>
