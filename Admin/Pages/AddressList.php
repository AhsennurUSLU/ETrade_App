<?php
require "../Aconfig.php";

session_start();
// Eğer kullanıcı giriş yapmamışsa, giriş sayfasına yönlendir
if(!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}

include "../../Main/Libs/connect.php";
include "../Libs/functions.php";

$sql = "SELECT * FROM address";
$result = mysqli_query($connection, $sql);


mysqli_close($connection);
?>

<?php include "../Views/_Aheader.php" ?>

<div class="container-fluid position-relative bg-white d-flex p-0">
    <?php include "../Views/_Asidebar.php" ?>
    <div class="content">
        <?php include "../Views/_Anavbar.php" ?>
        <br>
        <div class="container">
            <h6 class="mb-4">Adres Listesi</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kullanıcı ID</th>
                            <th scope="col">Adres ID</th>
                            <th scope="col">E-posta</th>
                            <th scope="col">Adres Başlığı</th>
                            <th scope="col">İl</th>
                            <th scope="col">İlçe</th>
                            <th scope="col">Mahalle</th>
                            <th scope="col">Posta Kodu</th>
                            <th scope="col">Full Adres</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                    if($result && mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $address_id = $row['id'];
                            $address_info_result = getAddressUserById($address_id);
                            if ($address_info_result && mysqli_num_rows($address_info_result) > 0) {
                                while ($address_row = mysqli_fetch_assoc($address_info_result)) {
                            echo  "<tr>";
                            echo     "<th scope='row'>" . "</th>";
                            echo    "<td>" . $address_row["user_id"] . "</td>";
                            echo     "<td>" . $address_row["address_id"] . "</td>";
                            echo     "<td>" . $address_row["email"] . "</td>";
                            echo     "<td>" . $address_row["address_title"] . "</td>";
                            echo     "<td>" . $address_row["city"] . "</td>";
                            echo     "<td>" . $address_row["district"] . "</td>";
                            echo     "<td>" .  $address_row["neighborhood"] ."</td>";
                            echo     "<td>" . $address_row['postal_code']  . "</td>";
                            echo     "<td>" . $address_row["full_address"] . "</td>";
                          
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12'>Kayıtlı adres bulunamadı.</td></tr>";
                    }
                }
            } else {
                echo "<tr><td colspan='12'>Adres bulunamadı.</td></tr>";
            }
               
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "../Views/_Ascripts.php" ?>
