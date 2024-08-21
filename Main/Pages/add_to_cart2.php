<?php
include __DIR__ . "/../../config.php"; 
include __DIR__ . "/../Libs/connect.php"; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Sepet oturumu kontrol et, yoksa oluştur
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Ürünü sepete ekle (veya varsa miktarını artır)
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }

    // Sepet sayfasına yönlendirme yap
    header("Location: cart.php");
    exit();
}


?>