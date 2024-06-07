<?php
session_start();
include "../../config.php";

require "../Libs/connect.php";

if (!isset($_SESSION['id'])) {
    header("location: Login.php");
    exit;
}


include "../Libs/functions.php";


$user_id = $_SESSION['id'];


// Kullanıcı bilgilerini çek
$sql = "SELECT * FROM address WHERE id = ?";
if ($stmt = mysqli_prepare($connection, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $selectedAddress = mysqli_fetch_assoc($result);
    } else {
        $selectedAddress = null;
    }
    mysqli_stmt_close($stmt);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addAddress'])) {
    $city = mysqli_real_escape_string($connection, $_POST['city']);
    $district = mysqli_real_escape_string($connection, $_POST['district']);
    $neighborhood = mysqli_real_escape_string($connection, $_POST['neighborhood']);
    $postal_code = mysqli_real_escape_string($connection, $_POST['postal_code']);
    $full_address = mysqli_real_escape_string($connection, $_POST['full_address']);
    $address_title = mysqli_real_escape_string($connection, $_POST['address_title']);

    $sql = "INSERT INTO address (city, district, neighborhood, postal_code, full_address,address_title) VALUES ('$city', '$district', '$neighborhood', '$postal_code', '$full_address', '$address_title')";
            
    if (mysqli_query($connection, $sql)) {
        // Kategori-Ürün ilişkisi 
        $address_id = mysqli_insert_id($connection);
        $address_info_sql = "INSERT INTO address_info (user_id, address_id) VALUES ('$user_id', '$address_id')";
        mysqli_query($connection, $address_info_sql);
        header("location: MyAddress.php");
        echo "Adres başarıyla eklendi.";
    } else {
        echo "Adres eklenirken hata oluştu: " . mysqli_error($connection);
    }

 
    mysqli_close($connection);
    }


?>





<?php require "../Views/_header.php";  ?>
<?php require "../Views/_navbar.php";  ?>



<div class="container mt-5">

    <div class="row">
        <div class="col-3">
            <?php require "../Views/_profile-sidebar.php";  ?>
        </div>


        <div class="col-9 ">




            <div class="card-body">

                <div class="container">
                    <h2>Adres Ekle</h2>
                    <form action="AddAddress.php" method="POST">

                        <div class="row">
                            <div class="col-6">
                                <label for="city" class="form-label">İl:</label>

                                <select id="city" name="city" class="form-control" required>
                                    <option value="">Seçiniz</option>
                                    <?php foreach (getData("../Libs/il-ilce.json")["data"] as $il) : ?>
                                        <option value="<?php echo $il["il_adi"]; ?>"><?php echo $il["il_adi"]; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="col-6">
                                <label for="district" class="form-label">İlçe:</label>
                                <select id="district" name="district" class="form-control" required>
                                    <option value="">Önce Şehir Seçiniz</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-2 mr-2 ml-2">
                                    <label for="neighborhood" class="form-label">Mahalle:</label>
                                    <input type="text" id="neighborhood" name="neighborhood" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2 mr-2 ml-2">
                                    <label for="postal_code" class="form-label">Posta Kodu:</label>
                                    <input type="text" id="postal_code" name="postal_code" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="full_address" class="form-label">Tam Adres:</label>
                            <textarea id="full_address" name="full_address" class="form-control" required></textarea>
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="address_title" class="form-label">Adres Başlığı</label>
                            <input type="text" id="address_title" name="address_title" class="form-control" required>
                        </div>

                        <button type="submit" name="addAddress" class="btn" style="background-color: #3C5B6F; color:white;">Ekle</button>
                    </form>
                </div>
            </div>

        </div>
    </div>


</div>



<?php include "../Views/_scripts.php"  ?>

<?php include "../Views/_footer.php"; ?>

<script>
    $(document).ready(function() {
        $('#city').change(function() {
            var selectedCity = $(this).val();
            var districtSelect = $('#district');
            districtSelect.empty();
            districtSelect.append('<option value="">Önce Şehir Seçiniz</option>');
            <?php foreach (getData("../Libs/il-ilce.json")["data"] as $il) : ?>
                if ("<?php echo $il["il_adi"]; ?>" === selectedCity) {
                    <?php foreach ($il["ilceler"] as $ilce) : ?>
                        districtSelect.append('<option value="<?php echo $ilce["ilce_adi"]; ?>"><?php echo $ilce["ilce_adi"]; ?></option>');
                    <?php endforeach; ?>
                }
            <?php endforeach; ?>
        });
    });
</script>

<!-- 
<script>
        $(document).ready(function() {
            // JSON verilerini al
            $.getJSON("../Libs/functions.php", function(data) {
                // Şehir dropdown doldurma
                var sehirDropdown = $("#city");
                $.each(data.data, function(index, value) {
                    sehirDropdown.append($('<option>', {
                        value: value.il_adi,
                        text: value.il_adi
                    }));
                });

                // Şehir seçildiğinde ilçe dropdown doldurma
                $("#city").change(function() {
                    var selectedSehir = $(this).val();
                    var ilceDropdown = $("#district");
                    ilceDropdown.empty();
                    ilceDropdown.append('<option value="">İlçe seçiniz</option>');

                    $.each(data.data, function(index, value) {
                        if (value.il_adi === selectedSehir) {
                            $.each(value.ilceler, function(index, ilceValue) {
                                ilceDropdown.append($('<option>', {
                                    value: ilceValue.ilce_adi,
                                    text: ilceValue.ilce_adi
                                }));
                            });
                        }
                    });
                });
            });
        });
    </script> -->