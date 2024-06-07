<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'remove' && isset($_GET['product_id'])) {
        $product_id = intval($_GET['product_id']);
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
    }

    if ($action == 'clear') {
        unset($_SESSION['cart']);
    }
}

header('Location: MyCart.php');
exit;
?>
