

<?php require "../Aconfig.php"  ?>
<?php include "../Views/_Aheader.php" ?>
<?php include "../Libs/functions.php" ?>

<?php

require_once "../../Main/Libs/connect.php";


session_start();

function login($connection, $email, $password) {
    // Veritabanı sorgusu
    $query = "SELECT id, email, password FROM admin WHERE email = ?";
    if ($stmt = mysqli_prepare($connection, $query)) {
        $param_email = $email;
        mysqli_stmt_bind_param($stmt, "s", $param_email);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $email, $password);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $password)) {

                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["email"] = $email;
                      

                        header("location: ../home.php?id=" . $id);
                    } else {
                       echo "Yanlış Şifre girdiniz.";
                    }
                }
            } else {
                echo "Yanlış E-mail girdiniz.";
            }
        } else {
            echo "Bilinmeyen bir hata oluştu";
        }
        mysqli_stmt_close($stmt);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (login($connection, $email, $password)) {
        header('Location: ../home.php');
        exit();
    } else {
        echo "Geçersiz e-posta veya şifre. Lütfen tekrar deneyin.";
    }
}

$connection->close();
?>












<div class="container-fluid position-relative bg-white d-flex p-0">

    <!-- Sign In Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="text-center mb-4">
                        <h3 class="text-primary">Yönetim Paneli/Giriş Yap</h3>
                    </div>
                    <form action="Login.php" method="POST">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="Email">
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Şifre">
                            <label for="floatingPassword">Şifre</label>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg" type="submit" name="login">Giriş Yap</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign In End -->
</div>

<?php include "../Views/_Ascripts.php" ?>