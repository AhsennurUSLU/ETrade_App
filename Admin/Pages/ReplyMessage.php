<?php

require_once "../Aconfig.php";

session_start();
// Eğer kullanıcı giriş yapmamışsa, giriş sayfasına yönlendir
if(!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}
require_once "../Libs/functions.php";
require_once "../../Main/Libs/connect.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';

$id = $_GET["id"];
$result = getMessageById($id);

if ($result) {
    $selectedMessage = mysqli_fetch_assoc($result);
    $replyEmail = $selectedMessage['email'];
    $replyName = $selectedMessage['name'];
} else {
    echo "Mesaj bulunamadı.";
    exit();
}


$replySubject = $_POST['subject'] ?? '';
$replyMessage = $_POST['content'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$mail = new PHPMailer(true);

try {
    // SMTP ayarları
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'etradeinfo7@gmail.com';  
    $mail->Password = 'xaki dwzq nguv rvye';  
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // E-posta bilgileri
    $mail->setFrom('etradeinfo7@gmail.com', 'EtradeApp'); // Gönderen e-posta adresi
    $mail->addAddress($replyEmail, $replyName);  // Alıcı e-posta adresi
    $mail->addReplyTo('etradeinfo7@gmail.com', 'EtradeApp'); // Yanıtlayan kişinin bilgileri

    // İçerik
    $mail->isHTML(true);
    $mail->Subject = $replySubject;
    $mailContent = "
        <h2>Etrade uygulama Mesajı</h2>
        <p><strong>Ad:</strong> EtradeApp</p>
        <p><strong>E-posta:</strong> etradeinfo7@gmail.com</p>
        <p><strong>Konu:</strong> {$replySubject}</p>
        <p><strong>Mesaj:</strong>{$replyMessage}</p>
        
    ";
    $mail->Body = $mailContent;

    // E-posta gönderimi
    if ($mail->send()) {
        echo "<div class='alert alert-info'>Mesajınız gönderildi.</div>";
        header("Location: DisplayMessage.php?id={$id}");
        exit();
    } else {
        echo "<div class='alert alert-info'>Mesajınız gönderilemedi. Lütfen tekrar deneyin.</div>";
    }
} catch (Exception $e) {
    echo "Mesajınız gönderilemedi. Hata: {$mail->ErrorInfo}";
}

}

// Mesaj bilgilerini ve yanıt formunu içeren HTML kodu
include "../Views/_Aheader.php";
include "../Views/_Asidebar.php";
echo "<div class='content'>";
include "../Views/_Anavbar.php";
?>
<br><br><br><br><br>
<div class="container">
    <div class="col-6">
        <div class="card p-4">
            <div class="card-body p-3">
                <h6 class="mb-4">Yanıtla</h6>
                <form action="ReplyMessage.php?id=<?php echo $id; ?>" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">İsim</label>
                        <input type="text" class="form-control" id="name" value="<?php echo $replyName; ?>" name="name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Gönderilecek E-posta</label>
                        <input type="email" class="form-control" id="email" value="<?php echo $replyEmail; ?>" name="email" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Mesaj Konusu</label>
                        <input type="text" class="form-control" id="subject" name="subject" >
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Mesaj İçeriği</label>
                        <textarea class="form-control" id="content" name="content" rows="4" ></textarea>
                    </div>
                    <hr>
                
                    <button type="submit" name="replyMessage" class="btn btn-primary">Gönder</button>
                </form>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br>
</div>
<?php include "../Views/_Ascripts.php"; ?>
