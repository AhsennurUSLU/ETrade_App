<?php require "../Aconfig.php"  ?>
<?php

session_start();
// Eğer kullanıcı giriş yapmamışsa, giriş sayfasına yönlendir
if(!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}


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