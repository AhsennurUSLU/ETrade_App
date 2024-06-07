<?php require "../Aconfig.php"  ?>

<?php  


include "../../Main/Libs/connect.php";
include "../Libs/functions.php";

$id = $_GET["id"];
$result = getMessageById($id);
$selectedMessage = mysqli_fetch_assoc($result);

$sql1 = "SELECT * FROM messages";
$result1 = mysqli_query($connection, $sql1);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["displayMessage"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
  
   

}

function getMessageById(int $id) {
    include "../../Main/Libs/connect.php";

    $query = "SELECT * FROM messages WHERE id='$id'";
    $result = mysqli_query($connection,$query);
    mysqli_close($connection);
    return $result;
}


?>


<?php include "../Views/_Aheader.php"; ?>
<div class="container-fluid position-relative bg-white d-flex p-0">
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php include "../Views/_Asidebar.php"; ?>
    <div class="content">
        <?php include "../Views/_Anavbar.php"; ?>
        <br><br><br><br><br>
        <div class="container">
            <div class="col-6">
                <div class="card p-4">
                    <div class="card-body p-3">
                        <h6 class="mb-4">Gelen Mesaj</h6>
                        <form action="DisplayMessage.php?id=<?php echo $id; ?>" method="POST" >
                        
                        
                            <div class="mb-3">
                                <label for="name" class="form-label">İsim</label>
                                <input type="text" class="form-control " id="name" value="<?php echo $selectedMessage["name"]; ?>" name="name">
                               
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Gönderen E-posta</label>
                                <input type="email" class="form-control " id="email" value="<?php echo $selectedMessage["email"]; ?>" name="email">
                               
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Mesaj Konusu</label>
                                <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $selectedMessage["subject"]; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Mesaj İçeriği</label>
                                <input type="text" class="form-control" id="message" name="message" value="<?php echo $selectedMessage["message"]; ?>">
                            </div>
                           
                            <a class='btn btn-light' type='submit' name='replyMessage' href="ReplyMessage.php?id=<?php echo $id; ?>" >Yanıtla</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br><br>
    </div>
</div>
<?php include "../Views/_Ascripts.php"; ?>



