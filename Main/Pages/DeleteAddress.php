<?php include "../../config.php";  ?>
<?php


include "../Libs/connect.php";
include "../Libs/functions.php";

$id = $_GET["id"];

if (deleteAddress($id)) {
    $_SESSION['message'] = $id." id numaralı Adres silindi.";
    $_SESSION['type'] = "danger";

    header('Location: MyAddress.php');
} else {
    echo "Adres silinirken bir hata oluştu";
} 





?>