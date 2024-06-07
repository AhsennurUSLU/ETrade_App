<?php
require "../Libs/connect.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sendMessage"])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    $name_err = $email_err = $subject_err = $message_err = "";
    
    // İsim doğrulama
    if (empty($name)) {
        $name_err = "Adınızı girmelisiniz.";
    }
    
    // E-posta doğrulama
    if (empty($email)) {
        $email_err = "E-posta adresinizi girmelisiniz.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Geçerli bir e-posta adresi giriniz.";
    }
    
    // Konu doğrulama
    if (empty($subject)) {
        $subject_err = "Konu başlığını girmelisiniz.";
    }
    
    // Mesaj doğrulama
    if (empty($message)) {
        $message_err = "Mesajınızı yazmalısınız.";
    }
    
    if (empty($name_err) && empty($email_err) && empty($subject_err) && empty($message_err)) {
        // Veritabanına ekleme
        $sql = "INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
        if ($stmt = $connection->prepare($sql)) {
            $stmt->bind_param("ssss", $name, $email, $subject, $message);
            $stmt->execute();
            $stmt->close();
        }
        
        // E-posta gönderme işlemi
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
            $mail->setFrom($email, $name);
            $mail->addAddress('etradeinfo7@gmail.com', 'AtradeApp');  // Alıcı e-posta adresi
            $mail->addReplyTo($email, $name);

            // İçerik
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mailContent = "
                <h2>Etrade uygulama Mesajı</h2>
                <p><strong>Ad:</strong> {$name}</p>
                <p><strong>E-posta:</strong> {$email}</p>
                <p><strong>Konu:</strong> {$subject}</p>
                <p><strong>Mesaj:</strong></p>
                <p>{$message}</p>
            ";
            $mail->Body = $mailContent;

            if ($mail->send()) {
                $_SESSION['message'] = "Mesajınız gönderildi.";
            } else {
                $_SESSION['message'] = "Mesajınız gönderilemedi. Lütfen tekrar deneyin.";
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "Mesajınız gönderilemedi. Hata: {$mail->ErrorInfo}";
        }
    }
}

$connection->close();
 
header("Location: Contact.php");
exit();
?>
