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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editAddress'])) {
    $city = mysqli_real_escape_string($connection, $_POST['city']);
    $district = mysqli_real_escape_string($connection, $_POST['district']);
    $neighborhood = mysqli_real_escape_string($connection, $_POST['neighborhood']);
    $postal_code = mysqli_real_escape_string($connection, $_POST['postal_code']);
    $full_address = mysqli_real_escape_string($connection, $_POST['full_address']);
    $address_title = mysqli_real_escape_string($connection, $_POST['address_title']);
  

    if ($selectedAddress) {
        // Güncelleme işlemi
        $sql = "UPDATE address SET city=?, district=?, neighborhood=?, postal_code=?, full_address=?, address_title=? WHERE id=?";
        if ($stmt = mysqli_prepare($connection, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssi", $city, $district, $neighborhood, $postal_code, $full_address, $address_title, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            header("location: MyAddress.php");
            exit;
        }
    }
}

mysqli_close($connection);
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
                    <form action="EditAddress.php" method="POST">
                        <div class="row">
                            <div class="col-6">
                                <label for="city" class="form-label">İl:</label>
                                <select id="city" name="city" class="form-control" required>
                                    <option value="">Seçiniz</option>
                                    <?php 
                                    $savedCity = isset($selectedAddress["city"]) ? $selectedAddress["city"] : '';
                                    foreach (getData("../Libs/il-ilce.json")["data"] as $il) : 
                                    ?>
                                        <option value="<?php echo $il["il_adi"]; ?>" <?php echo ($il["il_adi"] == $savedCity) ? 'selected' : ''; ?>><?php echo $il["il_adi"]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="district" class="form-label">İlçe:</label>
                                <select id="district" name="district" class="form-control" required>
                                    <option value="">Önce Şehir Seçiniz</option>
                                    <?php 
                                    $savedDistrict = isset($selectedAddress["district"]) ? $selectedAddress["district"] : '';
                                    if ($savedCity) {
                                        foreach (getData("../Libs/il-ilce.json")["data"] as $il) {
                                            if ($il["il_adi"] == $savedCity) {
                                                foreach ($il["ilceler"] as $ilce) {
                                                    echo '<option value="' . $ilce["ilce_adi"] . '"' . ($ilce["ilce_adi"] == $savedDistrict ? ' selected' : '') . '>' . $ilce["ilce_adi"] . '</option>';
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-2 mr-2 ml-2">
                                    <label for="neighborhood" class="form-label">Mahalle:</label>
                                    <input type="text" id="neighborhood" name="neighborhood" class="form-control" value="<?php echo isset($selectedAddress["neighborhood"]) ? $selectedAddress["neighborhood"] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2 mr-2 ml-2">
                                    <label for="postal_code" class="form-label">Posta Kodu:</label>
                                    <input type="text" id="postal_code" name="postal_code" class="form-control" value="<?php echo isset($selectedAddress["postal_code"]) ? $selectedAddress["postal_code"] : ''; ?>">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="full_address" class="form-label">Tam Adres:</label>
                            <textarea id="full_address" name="full_address" class="form-control"><?php echo isset($selectedAddress["full_address"]) ? $selectedAddress["full_address"] : ''; ?></textarea>
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="address_title" class="form-label">Adres Başlığı</label>
                            <input type="text" id="address_title" name="address_title" class="form-control" value="<?php echo isset($selectedAddress["address_title"]) ? $selectedAddress["address_title"] : ''; ?>">
                        </div>
                        <button type="submit" name="editAddress" class="btn btn-success">Düzenle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../Views/_scripts.php"; ?>
<?php include "../Views/_footer.php"; ?>

<script>
    $(document).ready(function() {
        var savedCity = "<?php echo $savedCity; ?>";
        if (savedCity) {
            loadDistricts(savedCity);
        }
        $('#city').change(function() {
            var selectedCity = $(this).val();
            loadDistricts(selectedCity);
        });

        function loadDistricts(city) {
            var districtSelect = $('#district');
            districtSelect.empty();
            districtSelect.append('<option value="">Önce Şehir Seçiniz</option>');
            <?php foreach (getData("../Libs/il-ilce.json")["data"] as $il) : ?>
                if ("<?php echo $il["il_adi"]; ?>" === city) {
                    <?php foreach ($il["ilceler"] as $ilce) : ?>
                        districtSelect.append('<option value="<?php echo $ilce["ilce_adi"]; ?>" <?php echo ($ilce["ilce_adi"] == $savedDistrict) ? 'selected' : ''; ?>><?php echo $ilce["ilce_adi"]; ?></option>');
                    <?php endforeach; ?>
                }
            <?php endforeach; ?>
        }
    });
</script>
