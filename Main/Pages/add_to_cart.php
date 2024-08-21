<?php



if (session_status() == PHP_SESSION_NONE) {
    session_start();
}




$response = array('status' => 'error', 'message' => 'Bir hata oluştu', 'cart_count' => 0);

if (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }

    $response['status'] = 'success';
    $response['message'] = 'Ürün sepete eklendi';
    $response['cart_count'] = array_sum($_SESSION['cart']);
}

echo json_encode($response);



?>




