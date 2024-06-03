<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../../config.php"  ;
include "../Libs/functions.php";

include "../Libs/connect.php";


$email = $password = "";
$email_err = $password_err = "";


if (isset($_POST["register"])) {

    if (empty(trim($_POST["email"]))) {
        $email_err = "E-mail boş geçilemez";
     } //else if (strlen(trim($_POST["email"])) < 5 or strlen(trim($_POST["email"])) > 15) {
    //     $email_err = "girdiğiniz email 5 ile 15 karakter arasında olmalıdır.";
    // } //else if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
    //     $email_err ="Lütfen geçerli bir Email giriniz";
    // }
    else {

        $sql = "SELECT id FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($connection,$sql)){
            $param_email = trim($_POST["email"]);
            mysqli_stmt_bind_param($stmt,"s",$param_email);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "Bu E-mail daha önce alınmış.";
                }else{
                    $email = $_POST["email"];
                }
            }else{
                echo mysqli_error($connection);
                echo "Hata oluştu";
            }
       
    }

}





    if (empty(trim($_POST["password"]))) {
        $password_err = "Şifre boş geçilemez";
    } //else if (!preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $_POST["password"])) {
    //     $password_err = "Girdiğiniz Şifre sadece rakam, harf ve alt çizgiden oluşmalıdır."; }
    else if (strlen($_POST["password"]) < 6) {
        $password_err = "Şifreniz 6 karakterden büyük olmalıdır.";
    } else {
        $password = $_POST["password"];
    }

    //RegisterUser($email, $password);

    if (empty($email_err) && empty($password_err)) {
        $sql = "INSERT INTO users(email,password) VALUES(?,?)";
        if ($stmt = mysqli_prepare($connection, $sql)) {
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);

            if (mysqli_stmt_execute($stmt)) {
                session_start();
             
                $_SESSION["id"] = $id;
              
                header("location: Login.php?id=$id");
            }else{
                echo mysqli_error($connection);
                echo "hata oluştu";
            }

        }
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

                    <form action="Register.php" method="POST" novalidate>



                        <div class="mb-2 mr-2 ml-2">
                            <label for="email" class="form-label">E-Posta</label>
                            <input type="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : '' ?>" name="email" value="<?php echo $email; ?>" id="email">
                            <span class="invalid-feedback"><?php echo $email_err ?></span>
                        </div>
                        <div class="mb-2 mr-2 ml-2">
                            <label for="password" class="form-label">Şifre</label>
                            <input type="password" class="form-control  <?php echo (!empty($password_err)) ? 'is-invalid' : '' ?>" name="password" value="<?php echo $password; ?>" id="password">
                            <span class="invalid-feedback"><?php echo $password_err ?></span>
                        </div>

                        <input type="submit" name="register" value="Kayıt Ol" class="btn btn-success">
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include "../Views/_scripts.php" ; ?>
<?php include "../Views/_footer.php"; ?>