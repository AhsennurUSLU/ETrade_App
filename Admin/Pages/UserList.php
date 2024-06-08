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

$sql = "SELECT * FROM user_details";
$result = mysqli_query($connection, $sql);

?>



<?php include "../Views/_Aheader.php" ?>

<div class="container-fluid position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->
    <?php include "../Views/_Asidebar.php" ?>
    <div class="content">
        <?php include "../Views/_Anavbar.php" ?>

        <br>
        <br>
        <br>
        <br>
        <br>



        <div class="container">
      

            <h6 class="mb-4">Kullanıcı Listesi</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kullanıcı Resmi</th>
                            <th scope="col">Kullanıcı ID</th>
                            <th scope="col">Kullanıcı Adı</th>
                            <th scope="col">Kullanıcı Soyadı</th>
                            <th scope="col">Kullanıcı Cinsiyeti</th>
                            <th scope="col">Kullanıcı Yaşı</th>
                            <th scope="col">Kullanıcı Emaili</th>
                            <th scope="col">Kullanıcı Doğum Tarihi</th>
                            <th scope="col">Kullanıcı Telefon Numarası</th>
                            <th scope="col">Kullanıcı Boy</th>
                            <th scope="col">Kullanıcı Kilo</th>
                            <th scope="col">Kullanıcı Aktifliği</th>
                        

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    
                        if($result && mysqli_num_rows($result) > 0){
                            while($user_row = mysqli_fetch_assoc($result)){
          
                                echo  "<tr>";
                                echo    "<td>" . "</td>";
                                echo     "<td><img src='"  . $user_row["image"] . "' alt='User Image' width='150'> </td>";
                                echo    "<td>" . $user_row["id"] . "</td>";
                                echo     "<td>" . $user_row["name"] . "</td>";
                                echo     "<td>" . $user_row["surname"] . "</td>";
                                echo     "<td>" . $user_row["gender"] . "</td>";
                                echo     "<td>" . $user_row["age"] . "</td>";
                                echo     "<td>" . $user_row["email"] ."</td>";
                                echo     "<td>" .  $user_row["birthdate"] ."</td>";
                                echo     "<td>" .  $user_row["phone"] ."</td>";
                                echo     "<td>" .  $user_row["height"] ."</td>";
                                echo     "<td>" .  $user_row["kilo"] ."</td>";
                                echo     "<td>" . ($user_row['isActive'] ? 'Aktif' : 'Pasif')  . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='12'>Kayıtlı kullanıcı bulunamadı.</td></tr>";
                        }
                 
                        ?>
                    </tbody>
                </table>
            </div>


        </div>

        <br>
        <br>
        <br>
        <br>
        <br>




    </div>

</div>
<?php include "../Views/_Ascripts.php" ?>