
<?php require "../config.php"; ?>

<?php require "../Views/_header.php"; ?>


<?php




// REGISTER İŞLEMLERİ


function RegisterUser(string $email, string $password, int $isActive = 1)
{
    include "connect.php";

    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

//     $query = "INSERT INTO Users (email, password, isActive) VALUES (? , ? , ?)";
//     $stmt = mysqli_prepare($connection,$query);

//     mysqli_stmt_bind_param($stmt, 'ssi', $email, $password, $isActive);
//     $result = mysqli_stmt_execute($stmt);
   
//     mysqli_stmt_close($stmt);
//     mysqli_close($connection);

//    return $result;  

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$query = "INSERT INTO users (email, password, isActive) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt === false) {
        die('mysqli_prepare() failed: ' . htmlspecialchars(mysqli_error($connection)));
    }

    // Parametreleri bağla
    mysqli_stmt_bind_param($stmt, 'ssi', $email, $hashedPassword, $isActive);

    // Sorguyu çalıştır
    $result = mysqli_stmt_execute($stmt);

    // Hata kontrolü
    if ($result === false) {
        die('mysqli_stmt_execute() failed: ' . htmlspecialchars(mysqli_stmt_error($stmt)));
    }

    // Kaynakları kapat
    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    return $result;  
   
}


function control_input($data){
    $data = htmlspecialchars($data);
    $data = stripslashes($data);

    return $data;
}





// LOGIN İŞLEMLERİ


if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($email == user["email"] and $password == user["password"]) {

        header('Location: ../index.php');
    } else {
        echo "<div class='alert alert-danger mb-0 text-center' role='alert' >Yanlış Kullanıcı adı veya şifre girdiniz!</div>";

        header('Location: ../Pages/Login.php');
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

// $jsonFilePath = "il-ilce.json";
// $jsonVerileri = getData($jsonFilePath);
// print_r($jsonVerileri);

// Şehir getirme işlemleri





?>
