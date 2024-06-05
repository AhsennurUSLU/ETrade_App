
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function control_input($data)
{
    $data = htmlspecialchars($data);
    $data = stripslashes($data);

    return $data;
}




function isLoggedin()
{
    if (isset($_SESSION["loggedin"])  &&  $_SESSION["loggedin"] == true) {
        return true;
    } else {
        return false;
    }
}

// delete addres fonksiyonu


function deleteAddress($id)
{
    include "../Libs/connect.php";


    $query1 = "DELETE FROM address_info WHERE address_id = $id";
    $query2 = "DELETE FROM address WHERE id = $id";

    $result1 = mysqli_query($connection, $query1);
    $result2 = mysqli_query($connection, $query2);


    if ($result1 && $result2) {
        return true;
    } else {
        return false;
    }
}



// Veri tabanından id ye göre ürün getirme



function getProductById($product_id)
{
    include "../Libs/connect.php";

    $query = "SELECT * FROM products WHERE id = ?";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $product_id);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($result);
}







// JSON İŞLEMLERİ




$jsonFilePath = "il-ilce.json";
function getData($jsonFilePath)
{
    if (!file_exists($jsonFilePath) || !is_readable($jsonFilePath)) {
        die("Dosya okunamadı veya mevcut değil.");
    }

    $jsonData = file_get_contents($jsonFilePath);
    $data = json_decode($jsonData, true);


    if (json_last_error() !== JSON_ERROR_NONE) {
        die("JSON verisi çözümlemesi sırasında bir hata oluştu: " . json_last_error_msg());
    }


    return $data;
};

function getDistrict()
{
    $data = getData("il-ilce.json");

    if (isset($data['data']) && is_array($data['data'])) {
        foreach ($data['data'] as $province) {
            if (isset($province['il_adi']) && isset($province['ilceler']) && is_array($province['ilceler'])) {
                foreach ($province['ilceler'] as $district) {
                    if (isset($district['il_adi']) && isset($district['ilce_adi'])) {
                        $il = $district['il_adi'];
                        $ilce = $district['ilce_adi'];

                        // İl ve ilçe isimlerini bir diziye ekleyin

                        return $ilce;
                    }
                }
            } else {
                return "İl veya ilçe bilgileri bulunamadı.";
            }
        }
    } else {
        return "'data' anahtarı mevcut değil veya bir dizi değil.";
    }
}







?>
