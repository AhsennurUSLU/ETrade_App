<?php
include "../../config.php" ;
require "../Libs/variables.php";

?>


<?php require "../Views/_header.php";  ?>
<?php require "../Views/_navbar.php";  ?>



<div class="container mt-5">

    <div class="row">
        <div class="col-3">
        <?php require "../Views/_profile-sidebar.php";  ?>
        </div>
   

    <div class="col-9 ">

     
            <img src="../../Assets/images/profiller/female-profile.png" alt="profile" width="150px" class="ml-5"/>

            <div class="card-body">

                    <form action="../Libs/functions.php" method="POST">

                    <div class="mb-2 mr-2 ml-2">
                            <label for="name" class="form-label">İsim</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="surname" class="form-label">Soyisim</label>
                            <input type="text" class="form-control" name="surname" id="surname">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="gender" class="form-label">Cinsiyet</label>
                            <input type="text" class="form-control" name="gender" id="gender">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="age" class="form-label">Yaş</label>
                            <input type="text" class="form-control" name="age" id="age">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="email" class="form-label">E-Posta</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="password" class="form-label">Şifre</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="phone" class="form-label">Cep Telefonu</label>
                            <input type="text" class="form-control" name="phone" id="phone">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="lenght" class="form-label">Boy</label>
                            <input type="text" class="form-control" name="lenght" id="lenght">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="kilo" class="form-label">Kilo</label>
                            <input type="text" class="form-control" name="kilo" id="kilo">
                        </div>
                        <input type="submit" name="edit" value="Düzenle" class="btn btn-success">
                    </form>

                </div>
       
    </div>
</div>


</div>



<?php include "../Views/_scripts.php"  ?>

<?php include "../Views/_footer.php"; ?>