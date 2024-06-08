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
$result = getCategoryById($id);
$selectedCategory = mysqli_fetch_assoc($result);    

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoryName = $_POST["categoryName"];
    $categoryDescription = $_POST["categoryDescription"];
    $isActive = isset($_POST["isActive"]) ? 1 : 0;
    $categoryImage = $selectedCategory["image"]; 

    // Resim yükleme işlemi
    if(isset($_FILES["categoryImage"]) && $_FILES["categoryImage"]["error"] == 0){
        $allowed = ["jpg", "jpeg", "png"];
        $filename = $_FILES["categoryImage"]["name"];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        if(in_array($filetype, $allowed)){
            $categoryImage = "../Assets/uploads/" . basename($filename);
            move_uploaded_file($_FILES["categoryImage"]["tmp_name"], $categoryImage);
        } else {
            $categoryImage_err = "Lütfen geçerli bir görsel dosyası girin.";
        }
    }

    if (editCategory($id, $categoryName, $categoryDescription, $categoryImage, (int)$isActive)) {
        $_SESSION['message'] = $categoryName." isimli kategori güncellendi.";
        $_SESSION['type'] = "success";
        header('Location: CategoryList.php');
        exit();
    } else {
        echo "Bir hata oluştu.";
    }
}

?>







<?php include "../Views/_Aheader.php" ?>
<div class="container-fluid position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php include "../Views/_Asidebar.php" ?>
    <div class="content">
        <?php include "../Views/_Anavbar.php" ?>

        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="container">
            <div class="col-6 ">
                <div class="card p-4">
                    <div class="card-body p-3">
                        <h6 class="mb-4">Kategori Güncelle</h6>
                        <form action="EditCategory.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                            <div class="card mb-3">
                                <div class="card-body text-center">
                                    <label for="categoryImage" class="form-label">Resmi Güncelle</label>
                                    <div class="image-preview" style="position: relative;">
                                        <img src="<?php echo $selectedCategory["image"]; ?>" alt="<?php echo $selectedCategory["name"];?>" class="img-thumbnail" id="imagePreview" style="cursor: pointer; max-width: 100%; height: auto;">
                                        <input type="file" class="form-control-file" name="categoryImage" id="categoryImage" style="display: none;">
                                    </div>
                                    <span class="invalid-feedback d-block"><?php echo $categoryImage_err ?? ''; ?></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Kategori Adını Güncelle</label>
                                <input type="text" class="form-control <?php echo (!empty($categoryName_err)) ? 'is-invalid':'' ?>" id="categoryName" value="<?php echo $selectedCategory["name"];?>" name="categoryName">
                                <span class="invalid-feedback"><?php echo $categoryName_err ?? ''; ?></span>
                            </div>

                            <div class="mb-3">
                                <label for="categoryDescription" class="form-label">Açıklamayı Güncelle</label>
                                <input type="text" class="form-control <?php echo (!empty($categoryDescription_err)) ? 'is-invalid':'' ?>" id="categoryDescription" value="<?php echo $selectedCategory["description"];?>" name="categoryDescription">
                                <span class="invalid-feedback"><?php echo $categoryDescription_err ?? ''; ?></span>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="isActive" name="isActive" <?php echo ($selectedCategory["isActive"]) ? "checked" : ""; ?>>
                                <label class="form-check-label" for="isActive">Aktif</label>
                            </div>
                            <button type="submit" name="categoryUpdate" class="btn btn-primary">Kaydet</button>
                        </form>
                    </div>
                </div>
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


<script>
    document.getElementById('imagePreview').addEventListener('click', function() {
        document.getElementById('categoryImage').click();
    });

    document.getElementById('categoryImage').addEventListener('change', function() {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    });
</script>


