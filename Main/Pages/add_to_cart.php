<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
    
    $cart_count = array_sum($_SESSION['cart']);
    echo json_encode([
        'cart_count' => $cart_count,
        'message' => 'Ürün sepete eklendi!'
    ]);
}


?>