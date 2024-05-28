<?php require "../Aconfig.php"  ?>
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

            <h6 class="mb-4">Ürün Listesi</h6>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ürün Resmi</th>
                            <th scope="col">Ürün ID</th>
                            <th scope="col">Ürün Kategori ID</th>
                            <th scope="col">Ürün Adı</th>
                            <th scope="col">Ürün Açıklaması</th>
                            <th scope="col">Ürün Fiyat</th>
                            <th scope="col">Stok Durumu</th>
                            <th scope="col">Aktiflik Durumu</th>
                            <th scope="col">Oluşturma Tarihi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>John</td>
                            <td>Doe</td>
                            <td>jhon@email.com</td>
                            <td>USA</td>
                            <td>123</td>
                            <td>Member</td>
                            <td>USA</td>
                            <td>123</td>
                            <td>Member</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>mark@email.com</td>
                            <td>UK</td>
                            <td>456</td>
                            <td>Member</td>
                            <td>USA</td>
                            <td>123</td>
                            <td>Member</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>jacob@email.com</td>
                            <td>AU</td>
                            <td>789</td>
                            <td>Member</td>
                            <td>USA</td>
                            <td>123</td>
                            <td>Member</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>jacob@email.com</td>
                            <td>AU</td>
                            <td>789</td>
                            <td>Member</td>
                            <td>USA</td>
                            <td>123</td>
                            <td>Member</td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>jacob@email.com</td>
                            <td>AU</td>
                            <td>789</td>
                            <td>Member</td>
                            <td>USA</td>
                            <td>123</td>
                            <td>Member</td>
                        </tr>
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