<?php
session_start();
include "../../config.php";
require "../Libs/connect.php";

if (!isset($_SESSION['id'])) {
    header("location: Login.php");
    exit;
}

$user_id = $_SESSION['id'];

// Kullanıcı bilgilerini çek
$sql = "SELECT * FROM user_details WHERE id = ?";
if ($stmt = mysqli_prepare($connection, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $selectedUser = mysqli_fetch_assoc($result);
    } else {
        $selectedUser = null;
    }
    mysqli_stmt_close($stmt);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['AddUserDetails'])) {
    $userName = mysqli_real_escape_string($connection, $_POST['userName']);
    $userSurname = mysqli_real_escape_string($connection, $_POST['userSurname']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);
    $age = mysqli_real_escape_string($connection, $_POST['age']);
    $birthDate = mysqli_real_escape_string($connection, $_POST['birthDate']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $height = mysqli_real_escape_string($connection, $_POST['height']);
    $kilo = mysqli_real_escape_string($connection, $_POST['kilo']);

    $default_image_path = "../../Assets/user_details/female-profile.png";
    $image_path = $default_image_path;

    if (isset($_FILES["userImage"]) && $_FILES["userImage"]["size"] > 0) {
        $target_dir = "../../Assets/user_details/";
        $target_file = $target_dir . basename($_FILES["userImage"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["userImage"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["userImage"]["tmp_name"], $target_file)) {
                $image_path = $target_file;
            } else {
                echo "Resim yüklenirken hata oluştu.";
                exit;
            }
        } else {
            echo "Yüklenen dosya bir resim değil.";
            exit;
        }
    }

    if ($selectedUser) {
        // Güncelleme işlemi
        $sql = "UPDATE user_details SET name=?, surname=?, gender=?, age=?, image=?, email=?, birthdate=?, phone=?, height=?, kilo=? WHERE id=?";
        if ($stmt = mysqli_prepare($connection, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssssssi", $userName, $userSurname, $gender, $age, $image_path, $email, $birthDate, $phone, $height, $kilo, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    } else {
        // Ekleme işlemi
        $sql = "INSERT INTO user_details (id, name, surname, gender, age, image, email, birthdate, phone, height, kilo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($connection, $sql)) {
            mysqli_stmt_bind_param($stmt, "issssssssss", $user_id, $userName, $userSurname, $gender, $age, $image_path, $email, $birthDate, $phone, $height, $kilo);
            if (mysqli_stmt_execute($stmt)) {
                // user_info tablosuna ekleme
                $detail_id = mysqli_insert_id($connection);
                $user_info_sql = "INSERT INTO user_info (user_id, detail_id) VALUES (?, ?)";
                if ($stmt2 = mysqli_prepare($connection, $user_info_sql)) {
                    mysqli_stmt_bind_param($stmt2, "ii", $user_id, $detail_id);
                    mysqli_stmt_execute($stmt2);
                    mysqli_stmt_close($stmt2);
                }
            }
            mysqli_stmt_close($stmt);
        }
    }

    header("location: MyProfile.php");
    exit;
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


        <div class="col-6 m-auto ">
            <div class="card">
                <form action="Myprofile.php" method="POST" enctype="multipart/form-data">
                    <div class="card-header p-3">
                        <div class="card-body text-center">
                            <label for="userImage" class="form-label">Resmi Değiştir</label>
                            <div class="image-preview" style="position: relative;">
                                <?php if (isset($selectedUser["image"])) : ?>
                                    <img src="<?php echo $selectedUser["image"]; ?>" alt="<?php echo $selectedUser["name"]; ?>" class="img-thumbnail" id="imagePreview" style="cursor: pointer; max-width: 200px; height: auto;">
                                <?php else : ?>
                                    <img src="../../Assets/user_details/female-profile.png" alt="profile" width="200px" class="ml-5">
                                <?php endif; ?>
                                <input type="file" class="form-control-file" name="userImage" id="userImage" style="display: none;">
                            </div>

                        </div>
                    </div>
                    <div class="card-body p-3">



                        <div class="mb-2 mr-2 ml-2">
                            <label for="userName" class="form-label">İsim</label>
                            <input type="text" class="form-control" name="userName" id="userName" value="<?php echo isset($selectedUser["name"]) ? $selectedUser["name"] : ''; ?>">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="userSurname" class="form-label">Soyisim</label>
                            <input type="text" class="form-control" name="userSurname" id="userSurname" value="<?php echo isset($selectedUser["surname"]) ? $selectedUser["surname"] : ''; ?>">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="gender" class="form-label">Cinsiyet</label>
                            <select class="form-control" name="gender" id="gender" value="<?php echo $selectedUser["gender"]; ?>">
                                <option value="Kadın" <?php echo (isset($selectedUser["gender"]) && $selectedUser["gender"] == 'Kadın') ? 'selected' : ''; ?>>Kadın</option>
                                <option value="Erkek" <?php echo (isset($selectedUser["gender"]) && $selectedUser["gender"] == 'Erkek') ? 'selected' : ''; ?>>Erkek</option>
                            </select>
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="age" class="form-label">Yaş</label>
                            <input type="text" class="form-control" name="age" id="age" value="<?php echo isset($selectedUser["age"]) ? $selectedUser["age"] : ''; ?>">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="birthDate" class="form-label">Doğum Tarihi</label>
                            <input type="date" id="birthDate" name="birthDate" class="form-control" value="<?php echo isset($selectedUser["birthdate"]) ? $selectedUser["birthdate"] : ''; ?>">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="email" class="form-label">E-Posta</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($selectedUser["email"]) ? $selectedUser["email"] : ''; ?>">
                        </div>
                        
                        <div class="mb-2 mr-2 ml-2">
                            <label for="phone" class="form-label">Cep Telefonu</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo isset($selectedUser["phone"]) ? $selectedUser["phone"] : ''; ?>">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="height" class="form-label">Boy</label>
                            <input type="text" class="form-control" name="height" id="height" value="<?php echo isset($selectedUser["height"]) ? $selectedUser["height"] : ''; ?>">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="kilo" class="form-label">Kilo</label>
                            <input type="text" class="form-control" name="kilo" id="kilo" value="<?php echo isset($selectedUser["kilo"]) ? $selectedUser["kilo"] : ''; ?>">
                        </div>
                        <input type="submit" name="AddUserDetails" value="Kaydet" class="btn btn-success">


                    </div>
                </form>
            </div>
        </div>
    </div>


</div>



<?php include "../Views/_scripts.php"  ?>

<?php include "../Views/_footer.php"; ?>