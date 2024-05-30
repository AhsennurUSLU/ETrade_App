<?php include "../../config.php"  ?>

<?php require "../Views/_header.php";  ?>
<?php require "../Views/_navbar.php";  ?>




<div class="container mt-5 mb-5">
    <h1 class="mb-4">İletişim</h1>

    <!-- İletişim Bilgileri -->
    <div class="mb-5">
        <h3>İletişim Bilgileri</h3>
        <p><strong>Adres:</strong> Beyhekim, 42100 Sokak, Konya, Türkiye</p>
        <p><strong>Telefon:</strong> +90 123 456 78 90</p>
        <p><strong>E-posta:</strong> info@atradeapp.com</p>
        <p><strong>Çalışma Saatleri:</strong> Pazartesi - Cuma: 09:00 - 18:00</p>
    </div>

    <!-- İletişim Formu -->

    <form action="send_contact.php" method="POST">
    <h3>Bizimle İletişime Geçin</h3>
    <br>
        <div class="form-group">
            <label for="name">Adınız</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">E-posta</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="subject">Konu</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <div class="form-group">
            <label for="message">Mesajınız</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gönder</button>
    </form>
</div>






<?php include "../Views/_scripts.php"  ?>

<?php include "../Views/_footer.php"; ?>