<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>
<?php include "../../config.php"  ?>

<?php require "../Libs/functions.php"; ?>
<?php require "../Libs/connect.php"; ?>

<?php

if (isLoggedin()) {
    header("location: MyProfile.php?id=" . $_SESSION["id"]);
    exit;
}

$email = $password = "";
$email_err = $password_err = $login_err =  "";


if (isset($_POST["login"])) {

    if (empty(trim($_POST["email"]))) {
        $email_err = "E-mail girmelisiniz";
    } else {
        $email = $_POST["email"];
    }
    if (empty(trim($_POST["password"]))) {
        $password_err = "password girmelisiniz";
    } else {
        $password = $_POST["password"];
    }

    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT  id, email, password FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($connection, $sql)) {
            $param_email = $email;
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                          

                            header("location: MyProfile.php?id=" . $id);
                        } else {
                            $login_err = "Yanlış Şifre girdiniz.";
                        }
                    }
                } else {
                    $login_err = "Yanlış E-mail girdiniz.";
                }
            } else {
                echo "Bilinmeyen bir hata oluştu";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($connection);
}

?>




<?php require "../Views/_header.php";  ?>
<?php require "../Views/_navbar.php";  ?>

<br>

<div class="container col-12 col-md-6 col-lg-4 mt-5">
    <?php if (!empty($login_err)) {
        echo '<div class= "alert alert-danger">' . $login_err . '</div>';
    } ?>

    <div class="card mt-5">

        <div class="card-header text-center" style="background-color: #153448; color: white;">
            <h4>Merhaba,</h4>
            <h6>Trade’a giriş yap veya hesap oluştur, indirimleri kaçırma!</h6>
        </div>


        <div class="card-body"> 
            <br>
            <form action="Login.php" method="POST">

                <div class="form-group">
                    <label for="email" class="form-label">E-Posta</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Şifre</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <br>
                <div class="form-group text-center mt-3 ">
                    <input type="submit" name="login" value="Giriş Yap" class="btn" style="background-color: #3C5B6F; color: white;">

                </div>
            </form>

        </div>

    </div>

</div>
<br>
<br>
<br>
<br>


<?php include "../Views/_scripts.php"  ?>

<?php include "../Views/_footer.php"; ?>

