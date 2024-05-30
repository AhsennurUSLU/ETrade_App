<?php require "../Aconfig.php"  ?>

<?php

include "../../Main/Libs/connect.php";

$sql = "SELECT * FROM categories";
$result = mysqli_query($connection, $sql);

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

<div><a href="AddCategory.php"><i class="fa fa-arrow-left" ></i> Kategori Ekle</a></div>
<br>
<br>
            <h6 class="mb-4">Kategori Listesi</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kategori Resmi</th>
                            <th scope="col">Kategori ID</th>
                            <th scope="col">Kategori Adı</th>
                            <th scope="col">Kategori Açıklaması</th>
                            <th scope="col">Aktiflik Durumu</th>
                            <th scope="col">Oluşturma Tarihi</th>
                            <th scope="col">Düzenle</th>

                        </tr>
                    </thead>
                  
                    <tbody>
                 
                    <?php
                if($result && mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row['id'];
                        echo "<tr>";
                        echo "<th scope='row'>" . $row['id'] . "</th>";
                        echo "<td><img src='" . $row['image'] . "' alt='Category Image' width='150'></td>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . ($row['isActive'] ? 'Aktif' : 'Pasif') . "</td>";
                        echo "<td>" . $row['createdAt'] . "</td>";
                       
                        echo "<td>" ."<a class='btn btn-light' type='submit' name='editCategory' href='EditCategory.php?id=$id' >Düzenle</a>". "</td>";
                        echo "<td>" . "<a class='btn btn-light' type='submit' name='deleteCategory' href='DeleteCategory.php?id=$id' >Sil</a>"."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Kategori bulunamadı.</td></tr>";
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