<?php require "../Aconfig.php"  ?>

<?php 

session_start();
// Eğer kullanıcı giriş yapmamışsa, giriş sayfasına yönlendir
if(!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}

include "../../Main/Libs/connect.php";

$sql1 = "SELECT * FROM categories";
$result1 = mysqli_query($connection, $sql1);


// Ürün Ekleme

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addProduct'])) {
    $name = mysqli_real_escape_string($connection, $_POST['productName']);
    $description = mysqli_real_escape_string($connection, $_POST['productDescription']);
    $price = mysqli_real_escape_string($connection, $_POST['productPrice']);
    $stock = mysqli_real_escape_string($connection, $_POST['productStock']);
    $category_id = mysqli_real_escape_string($connection, $_POST['productCategory']);
    $isActive = isset($_POST['productIsActive']) ? 1 : 0;


    // Resim dosyası yükleme
    $target_dir = "../../Assets/products/";
    $target_file = $target_dir . basename($_FILES["productImage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Dosya türü kontrolü
    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
            // SQL sorgusu 
            $sql = "INSERT INTO products (name, description, price, stock, image, isActive) VALUES ('$name', '$description', '$price', '$stock', '$target_file', '$isActive')";
            
            if (mysqli_query($connection, $sql)) {
                // Kategori-Ürün ilişkisi 
                $product_id = mysqli_insert_id($connection);
                $category_product_sql = "INSERT INTO category_product (category_id, product_id) VALUES ('$category_id', '$product_id')";
                mysqli_query($connection, $category_product_sql);
                header("location: ProductList.php");
                echo "Ürün başarıyla eklendi.";
            } else {
                echo "Ürün eklenirken hata oluştu: " . mysqli_error($connection);
            }
        } else {
            echo "Resim yüklenirken hata oluştu.";
        }
    } else {
        echo "Yüklenen dosya bir resim değil.";
    }

    mysqli_close($connection);
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
            <div class="row">
                <div class="col-9">
                    <div class="card p-4">

                        <div class="card-body p-3">
                            <h6 class="mb-4">Ürün Ekle</h6>
                            <form action="AddProduct.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3 ">
                                    <label for="productName" class="form-label">Ürün Adı</label>
                                    <input type="text" class="form-control" id="productName"  name="productName">

                                </div>
                                <div class="mb-3">
                                    <label for="productCategory" class="form-label">Ürün Kategorisi</label>
                                    <select class="form-control" id="productCategory" name="productCategory" required>
                                        <?php
                                        if ($result1 && mysqli_num_rows($result1) > 0) {
                                            while ($row = mysqli_fetch_assoc($result1)) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                            }
                                        } else {
                                            echo "<option value=''>Kategori bulunamadı.</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="productDescription" class="form-label">Açıklama</label>
                                    <input type="text" class="form-control" id="productDescription" name="productDescription">
                                </div>
                                <div class="mb-3">
                                    <label for="productImage" class="form-label">Resim Yükle</label>
                                    <input class="form-control" type="file" id="productImage" name="productImage">
                                </div>
                                <div class="mb-3">
                                    <label for="productPrice" class="form-label">Fiyat</label>
                                    <input type="text" class="form-control" id="productPrice" name="productPrice">
                                </div>
                                <div class="mb-3">
                                    <label for="productStock" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="productStock" name="productStock">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="productIsActive" name="productIsActive">
                                    <label class="form-check-label" for="productIsActive">Aktif</label>
                                </div>
                                <button type="submit" name="addProduct" class="btn btn-primary">Kaydet</button>
                            </form>

                        </div>
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