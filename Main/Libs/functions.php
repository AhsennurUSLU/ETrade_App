
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function control_input($data){
    $data = htmlspecialchars($data);
    $data = stripslashes($data);

    return $data;
}




function isLoggedin(){
    if(isset($_SESSION["loggedin"])  &&  $_SESSION["loggedin"] == true){
        return true;
    }else{
        return false;
    }
}





// JSON İŞLEMLERİ

// $il_ilce = fopen("il-ilce.json","r");
// $size = filesize("il-ilce.json");

// $jsonData = json_decode(fread($il_ilce,$size),true);

// $il = $jsonData["ilceler"][2]["il_adi"];
// $ilce = $jsonData["ilceler"][3]["ilce_adi"];
// echo $jsonData["ilceler"][3]["ilce_adi"];


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
