<?php
session_start();
include "../../config.php";
require "../Libs/connect.php";

if (!isset($_SESSION['id'])) {
    header("location: Login.php");
    exit;
}

$user_id = $_SESSION['id'];

?>
<style>
    .small-card {
        width: 400px;
        margin: 10px;

    }

    .small-card .card-header,
    .small-card .card-body {
        padding: 10px;
    }

    .small-card .card-header {
        font-size: 1.1em;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }

    .small-card .card-body {
        font-size: 0.9em;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-buttons {
        display: flex;
        gap: 5px;
    }

    .card-buttons button {
        font-size: 0.8em;
        padding: 5px 10px;
    }
</style>
<?php require "../Views/_header.php";  ?>
<?php require "../Views/_navbar.php";  ?>



<div class="container mt-5">

    <div class="row">
        <div class="col-3">
            <?php require "../Views/_profile-sidebar.php";  ?>
        </div>


        <div class="col-9 ">



        <a type="button" class="btn" style="background-color: #3C5B6F; color:white;" href="AddAddress.php?id=<?php echo $user_id; ?>">Adres Ekle</a>
            <br>
            <br>
            <?php
            // Adresleri veritabanından çek
            $sql = "SELECT * FROM address INNER JOIN address_info ON address.id = address_info.address_id WHERE address_info.user_id = ?";
            if ($stmt = mysqli_prepare($connection, $sql)) {
                mysqli_stmt_bind_param($stmt, "i", $user_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                // Adres varsa ekrana yazdır
                if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="card small-card">
                        <div class="card-header"> <?php echo $row['address_title']; ?> </div>
                        <div class="card-body">
                            <?php echo $row['full_address']; ?>
                            <div class="card-buttons">
                                <a href="EditAddress.php?id=<?php echo $row['id']; ?>" class="btn btn-sm"style="background-color: #3C5B6F; color:white;">Düzenle</a>
                                <a href="DeleteAddress.php?id=<?php echo $row['id']; ?>" class="btn btn-sm" style="background-color: #6D2932; color:white;">Sil</a>
                            </div>
                        </div>
                    </div>
            <?php
                }} else {
                    echo "<tr><td colspan='7'>Kayıtlı adres bulunamadı.</td></tr>";
                }
                mysqli_stmt_close($stmt);
            }
            ?>
        </div>
    </div>


</div>
<br>
<br>
<br>
<br>
<br>
<br>


<?php include "../Views/_scripts.php"  ?>

<?php include "../Views/_footer.php"; ?>