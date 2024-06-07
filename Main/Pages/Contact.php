<?php include "../../config.php"  ?>

<?php require "../Views/_header.php";  ?>
<?php require "../Views/_navbar.php";  ?>




<div class="container mt-5 mb-5">
    <div class="row justify-content-between">
        <?php if (!empty($name_err) || !empty($email_err) || !empty($subject_err) || !empty($message_err)) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php if (!empty($name_err)) echo "<li>$name_err</li>"; ?>
                    <?php if (!empty($email_err)) echo "<li>$email_err</li>"; ?>
                    <?php if (!empty($subject_err)) echo "<li>$subject_err</li>"; ?>
                    <?php if (!empty($message_err)) echo "<li>$message_err</li>"; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="col-7">
            <?php if (isset($_SESSION['message'])) : ?>
                <div class='alert alert-info'><?php echo $_SESSION['message']; ?></div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
            <form action="send_contact.php" method="POST">
                <h3>Bizimle İletişime Geçin</h3>
                <br>
                <div class="form-group">
                    <label for="name">Adınız</label>
                    <input type="text" class="form-control" id="name" name="name" required value="<?php echo htmlspecialchars($name ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="email">E-posta</label>
                    <input type="email" class="form-control" id="email" name="email" required value="<?php echo htmlspecialchars($email ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="subject">Konu</label>
                    <input type="text" class="form-control" id="subject" name="subject" required value="<?php echo htmlspecialchars($subject ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="message">Mesajınız</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required><?php echo htmlspecialchars($message ?? ''); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="sendMessage">Gönder</button>
            </form>
        </div>

        <div class="col-4 ml-2">
            <div class="mb-5">
                <h3>İletişim Bilgileri</h3>
                <p><strong>Adres:</strong> Siteler,06160, Altındağ, Ankara, Türkiye</p>
                <p><strong>Telefon:</strong> +90 123 456 78 90</p>
                <p><strong>E-posta:</strong> etradeinfo7@gmail.com</p>
                <p><strong>Çalışma Saatleri:</strong> Pazartesi - Cuma: 09:00 - 18:00</p>
                <img src="../../Assets/images/genel/contact.jpg" alt="contact" width="400" height="300">
            </div>
        </div>
    </div>
</div>

<br>
<br>

<?php require "../Views/_scripts.php"; ?>
<?php require "../Views/_footer.php"; ?>