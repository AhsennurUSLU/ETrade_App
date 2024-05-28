<?php require "../Aconfig.php"  ?>

<?php 

include "../../Libs/connect.php";






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
                            <form>
                                <div class="mb-3 ">
                                    <label for="productName" class="form-label">Ürün Adı</label>
                                    <input type="text" class="form-control" id="productName"  name="productName">

                                </div>
                                <div class="mb-3 ">
                                    <label for="productCategory" class="form-label">Ürün Kategorisi</label>
                                    <input type="text" class="form-control" id="productCategory" name="productCategory">

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
                                <button type="submit" name="categoryAdd" class="btn btn-primary">Kaydet</button>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-3">

                    <div class="card">
                        <div class="card-body">
                            <h5>Kategori ID</h5>
                            <ul>

                                <li>Yiyecek - 1</li>
                                <li>Giyim - 2</li>
                                <li>Kitap - 3</li>
                                <li>Ayakkabı - 4</li>
                            </ul>
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