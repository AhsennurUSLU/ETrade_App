<?php require "../Aconfig.php"  ?>
<?php


include "../../Main/Libs/connect.php";
include "../Libs/functions.php";

$id = $_GET["id"];

if (deleteCategory($id)) {
    $_SESSION['message'] = $id." id numaralı kategori silindi.";
    $_SESSION['type'] = "danger";

    header('Location: CategoryList.php');
} else {
    echo "hata";
} 





?>