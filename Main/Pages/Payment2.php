<?php
session_start();
include __DIR__ . "/../../config.php";
include __DIR__ . "/../Libs/connect.php";



if (!isset($_SESSION['order_id'])) {
    // Eğer order_id yoksa, kullanıcıyı anasayfaya yönlendir
    header("Location: ../index.php");
    exit();
}

$order_id = $_SESSION['order_id'];
include __DIR__ . "/../Views/_header.php";
include __DIR__ . "/../Views/_navbar.php";

// Gelen sipariş ID'sini al
//$order_id = $_GET['order_id'];

$query = "
    SELECT p.name, p.price, op.quantity, (p.price * op.quantity) AS total_price
    FROM order_product op
    INNER JOIN products p ON op.product_id = p.id
    WHERE op.order_id = ?
";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "i", $order_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<div class="container mt-5">
    <h1 class="mb-4">Siparişiniz Alındı</h1>

    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table table-bordered'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Ürün Adı</th>";
        echo "<th>Fiyat</th>";
        echo "<th>Miktar</th>";
        echo "<th>Toplam</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        $total_price = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $product_name = $row['name'];
            $product_price = $row['price'];
            $product_quantity = $row['quantity'];
            $total_product_price = $row['total_price'];
            $total_price += $total_product_price;

            echo "<tr>";
            echo "<td>$product_name</td>";
            echo "<td>$product_price TL</td>";
            echo "<td>$product_quantity</td>";
            echo "<td>$total_product_price TL</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "<div class='text-right'>";
        echo "<h4>Genel Toplam: <span class='total-price-summary'>$total_price TL</span></h4>";
        echo "</div>";
    } else {
        echo "<p>Hiç ürün bulunamadı.</p>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);
    ?>
    <a href="Categories.php" class="btn mt-3" style="background-color: #3C5B6F; color:white;">Alışverişe Devam Et</a>
</div>

<?php include __DIR__ . "/../Views/_scripts.php"; ?>
<?php include __DIR__ . "/../Views/_footer.php"; ?>
