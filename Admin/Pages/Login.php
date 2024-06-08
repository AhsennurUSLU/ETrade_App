

<?php require "../Aconfig.php"  ?>
<?php include "../Views/_Aheader.php" ?>
<?php include "../Libs/functions.php" ?>

<?php

require_once "../../Main/Libs/connect.php";





session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Veritabanı sorgusu
    $query = "SELECT id, email FROM admin WHERE email = ? AND password = ?";
    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            // Oturum yönetimi
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['loggedin'] = time();
            header('Location: ../home.php');
            exit();
        } else {
            echo "Geçersiz e-posta veya şifre. Lütfen tekrar deneyin.";
        }
        $stmt->close();
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