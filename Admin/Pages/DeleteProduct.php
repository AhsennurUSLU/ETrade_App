<?php require "../Aconfig.php"  ?>
<?php


include "../../Main/Libs/connect.php";
include "../Libs/functions.php";

$id = $_GET["id"];

if (deleteProduct($id)) {
    $_SESSION['message'] = $id." id numaralı kategori silindi.";
    $_SESSION['type'] = "danger";

    header('Location: ProductList.php');
} else {
    echo "Ürün silinirken bir hata oluştu";
} 





?>