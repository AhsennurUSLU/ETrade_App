<?php include "../config.php"  ?>
<?php require "../Libs/variables.php"; ?>

<?php 

if(isset($_POST["login"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    if($email == user["email"] and $password == user["password"]){

        header('Location: ../index.php');
    }else{
        echo "<div class='alert alert-danger mb-0 text-center' role='alert' >Yanlış Kullanıcı adı veya şifre girdiniz!</div>";
        sleep(1);
        header('Location: ../Pages/Login.php');
    }

}




?>






<?php require "../Views/_header.php";  ?>
<?php require "../Views/_navbar.php";  ?>


<div class="container my-5">

    <div class="row">

        <div class="col-12 m-5">

            <div class="card m-5 p-3">

                <div class="card-body">

                    <form action="Login.php" method="POST">

                        <div class="mb-2 mr-2 ml-2">
                            <label for="email" class="form-label">E-Posta</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="password" class="form-label">Şifre</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <input type="submit" name="login" value="Giriş Yap" class="btn btn-success">
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include "../Views/_scripts.php"  ?>

<?php include "../Views/_footer.php"; ?>