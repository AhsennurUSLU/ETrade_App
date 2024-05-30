<?php include "../../config.php"  ?>

<?php require "../Libs/functions.php"; ?>
<?php require "../Libs/connect.php"; ?>

<?php 

if(isLoggedin()){
    header("location: ../index.php");
    exit;
}

$email = $password = "";
$email_err = $password_err = $login_err=  "";


if (isset($_POST["login"])) {

    if (empty(trim($_POST["email"]))) {
        $email_err = "E-mail girmelisiniz";
    } else{
        $email = $_POST["email"];
    }
    if (empty(trim($_POST["password"]))) {
        $password_err = "password girmelisiniz";
    }else{
        $password = $_POST["password"];
    }
    
    if(empty($email_err) && empty($password_err)){
        $sql = "SELECT  email, password FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($connection,$sql)){
            $param_email = $email;
            mysqli_stmt_bind_param($stmt,"s",$param_email);

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt,$email,$hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            $_SESSION["loggedin"] = true;
                           // $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                           // $_SESSION["userType"] = $userType;

                            header("location: ../index.php ");
                        }else{
                            $login_err = "Yanlış Şifre girdiniz.";
                        }
                    }
                }else{
                    $login_err = "Yanlış E-mail girdiniz.";
                }
            }else{
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


<div class="container my-5">
<?php if(!empty($login_err)){
    echo '<div class= "alert alert-danger">'.$login_err.'</div>';
}?>

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