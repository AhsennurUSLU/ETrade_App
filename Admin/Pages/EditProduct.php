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
$result = getProductById($id);
$selectedProduct = mysqli_fetch_assoc($result);

$sql1 = "SELECT * FROM categories";
$result1 = mysqli_query($connection, $sql1);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["productUpdate"])) {
    $productName = $_POST["productName"];
    $productCategory = $_POST["productCategory"];
    $productDescription = $_POST["productDescription"];
    $productPrice = $_POST["productPrice"];
    $productStock = $_POST["productStock"];
    $isActive = isset($_POST["isActive"]) ? 1 : 0;
    $productImage = $selectedProduct["image"];

    // Resim yükleme işlemi
    if (isset($_FILES["productImage"]) && $_FILES["productImage"]["error"] == 0) {
        $allowed = ["jpg", "jpeg", "png"];
        $filename = $_FILES["productImage"]["name"];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        if (in_array($filetype, $allowed)) {
            $productImage = "../../Assets/products/" . basename($filename);
            move_uploaded_file($_FILES["productImage"]["tmp_name"], $productImage);
        } else {
            $productImage_err = "Lütfen geçerli bir görsel dosyası girin.";
        }
    }

    if (editProduct($id, $productName, $productDescription, $productPrice, $productStock, $productImage, (int)$isActive)) {
        // Kategori-Ürün ilişkisini güncelle
        $category_product_sql = "UPDATE category_product SET category_id = '$productCategory' WHERE product_id = '$id'";
        mysqli_query($connection, $category_product_sql);

        $_SESSION['message'] = $productName . " isimli ürün güncellendi.";
        $_SESSION['type'] = "success";
        header('Location: ProductList.php');
        exit();
    } else {
        echo "Bir hata oluştu.";
    }
}

function getProductById($id) {
    global $connection;
    $sql = "SELECT * FROM products WHERE id = '$id'";
    return mysqli_query($connection, $sql);
}

function editProduct($id, $name, $description, $price, $stock, $image, $isActive) {
    global $connection;
    $sql = "UPDATE products SET 
            name = '$name', 
            description = '$description', 
            price = '$price', 
            stock = '$stock', 
            image = '$image', 
            isActive = '$isActive' 
            WHERE id = '$id'";
    return mysqli_query($connection, $sql);
}

?>







<?php include "../Views/_Aheader.php"; ?>
<div class="container-fluid position-relative bg-white d-flex p-0">
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php include "../Views/_Asidebar.php"; ?>
    <div class="content">
        <?php include "../Views/_Anavbar.php"; ?>
        <br><br><br><br><br>
        <div class="container">
            <div class="col-6">
                <div class="card p-4">
                    <div class="card-body p-3">
                        <h6 class="mb-4">Ürün Güncelle</h6>
                        <form action="EditProduct.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                            <div class="card mb-3">
                                <div class="card-body text-center">
                                    <label for="productImage" class="form-label">Resmi Güncelle</label>
                                    <div class="image-preview" style="position: relative;">
                                        <img src="<?php echo $selectedProduct["image"]; ?>" alt="<?php echo $selectedProduct["name"]; ?>" class="img-thumbnail" id="imagePreview" style="cursor: pointer; max-width: 100%; height: auto;">
                                        <input type="file" class="form-control-file" name="productImage" id="productImage" style="display: none;">
                                    </div>
                                    <span class="invalid-feedback d-block"><?php echo $productImage_err ?? ''; ?></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Ürün Kategorisi</label>
                                <select class="form-control" id="productCategory" name="productCategory" required>
                                    <?php
                                    if ($result1 && mysqli_num_rows($result1) > 0) {
                                        while ($row = mysqli_fetch_assoc($result1)) {
                                            $selected = $row['id'] == $selectedProduct['category_id'] ? 'selected' : '';
                                            echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>Kategori bulunamadı.</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="productName" class="form-label">Ürün Adını Güncelle</label>
                                <input type="text" class="form-control <?php echo (!empty($productName_err)) ? 'is-invalid' : '' ?>" id="productName" value="<?php echo $selectedProduct["name"]; ?>" name="productName">
                                <span class="invalid-feedback"><?php echo $productName_err ?? ''; ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Açıklamayı Güncelle</label>
                                <input type="text" class="form-control <?php echo (!empty($productDescription_err)) ? 'is-invalid' : '' ?>" id="productDescription" value="<?php echo $selectedProduct["description"]; ?>" name="productDescription">
                                <span class="invalid-feedback"><?php echo $productDescription_err ?? ''; ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Fiyatı Güncelle</label>
                                <input type="text" class="form-control" id="productPrice" name="productPrice" value="<?php echo $selectedProduct["price"]; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="productStock" class="form-label">Stok Güncelle</label>
                                <input type="number" class="form-control" id="productStock" name="productStock" value="<?php echo $selectedProduct["stock"]; ?>">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="isActive" name="isActive" <?php echo ($selectedProduct["isActive"]) ? "checked" : ""; ?>>
                                <label class="form-check-label" for="isActive">Aktif</label>
                            </div>
                            <button type="submit" name="productUpdate" class="btn btn-primary">Güncelle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br><br>
    </div>
</div>
<?php include "../Views/_Ascripts.php"; ?>

<script>
    document.getElementById('imagePreview').addEventListener('click', function() {
        document.getElementById('productImage').click();
    });

    document.getElementById('productImage').addEventListener('change', function() {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    });
</script>

