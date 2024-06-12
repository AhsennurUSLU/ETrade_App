<?php
session_start();
include __DIR__ . "/../../config.php";
include __DIR__ . "/../Libs/connect.php";

// Kullanıcı ID'sini ve sepeti alın
$userId = $_SESSION['id'];
$cart = $_SESSION['cart'];

if (empty($cart)) {
    echo "Sepetinizde ürün bulunmamaktadır.";
    exit();
}

// 1. orders tablosuna yeni bir sipariş ekle
$query = "INSERT INTO orders (order_date) VALUES (NOW())";
if (mysqli_query($connection, $query)) {
    // Eklenen siparişin ID'sini al
    $order_id = mysqli_insert_id($connection);
} else {
    echo "Sipariş kaydedilirken bir hata oluştu: " . mysqli_error($connection);
    exit();
}

// 2. order_user tablosuna kullanıcı ve sipariş ilişkisini ekle
$query = "INSERT INTO order_user (order_id, user_id) VALUES (?, ?)";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "ii", $order_id, $userId);
if (!mysqli_stmt_execute($stmt)) {
    echo "Kullanıcı sipariş ilişkisi eklenirken bir hata oluştu: " . mysqli_stmt_error($stmt);
    mysqli_stmt_close($stmt);
    exit();
}
mysqli_stmt_close($stmt);

// 3. order_product tablosuna ürünleri ekle
foreach ($cart as $product_id => $quantity) {
    $query = "SELECT price FROM products WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $price);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    $query = "INSERT INTO order_product (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "iiid", $order_id, $product_id, $quantity, $price);
    if (!mysqli_stmt_execute($stmt)) {
        echo "Ürün sipariş ilişkisi eklenirken bir hata oluştu: " . mysqli_stmt_error($stmt);
        mysqli_stmt_close($stmt);
        exit();
    }
    mysqli_stmt_close($stmt);
}

// 4. Sepeti temizle
unset($_SESSION['cart']);

$_SESSION['order_id'] = $order_id;

// 5. Sipariş onay sayfasına yönlendir
header("Location: Payment2.php");
exit();
?>
