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

$sql = "SELECT * FROM products";
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
        <div><a href="AddProduct.php"><i class="fa fa-arrow-left" ></i> Ürün Ekle</a></div>
<br>
<br>

            <h6 class="mb-4">Ürün Listesi</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ürün Resmi</th>
                            <th scope="col">Ürün ID</th>
                            <th scope="col">Ürün Kategori ID</th>
                            <th scope="col">Ürün Kategori Adı</th>
                            <th scope="col">Ürün Adı</th>
                            <th scope="col">Ürün Açıklaması</th>
                            <th scope="col">Ürün Fiyat</th>
                            <th scope="col">Stok Durumu</th>
                            <th scope="col">Aktiflik Durumu</th>
                            <th scope="col">Oluşturma Tarihi</th>
                            <th scope="col">İşlem</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    
                        if($result && mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                $product_id = $row['id'];
                                $category_product_result = getCategoryProductById($product_id);
                                if ($category_product_result && mysqli_num_rows($category_product_result) > 0) {
                                    while ($category_product_row = mysqli_fetch_assoc($category_product_result)) {
                                echo  "<tr>";
                                echo     "<th scope='row'>" . $category_product_row["product_id"]  . "</th>";
                                echo     "<td><img src='"  . $category_product_row["product_image"] . "' alt='Category Image' width='150'> </td>";
                                echo    "<td>" . $category_product_row["product_id"] . "</td>";
                                echo     "<td>" . $category_product_row["category_id"] . "</td>";
                                echo     "<td>" . $category_product_row["category_name"] . "</td>";
                                echo     "<td>" . $category_product_row["product_name"] . "</td>";
                                echo     "<td>" . $category_product_row["product_description"] . "</td>";
                                echo     "<td>" . $category_product_row["product_price"] . " TL" ."</td>";
                                echo     "<td>" .  $category_product_row["product_stock"] . " adet"."</td>";
                                echo     "<td>" . ($category_product_row['product_isActive'] ? 'Aktif' : 'Pasif')  . "</td>";
                                echo     "<td>" . $category_product_row["product_createdAt"] . "</td>";
                                echo "<td>" ."<a class='btn btn-light' type='submit' name='editCategory' href='EditProduct.php?id=$product_id' >Düzenle</a>". "</td>";
                                echo "<td>" . "<a class='btn btn-light' type='submit' name='deleteCategory' href='DeleteProduct.php?id=$product_id' >Sil</a>"."</td>";
                                echo "</tr>";
                            }   
                        } else {
                            echo "<tr><td colspan='12'>Kategori veya ürün bulunamadı.</td></tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='12'>Ürün bulunamadı.</td></tr>";
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