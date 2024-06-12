<?php include __DIR__ . "/../../config.php"; ?>
<?php include __DIR__ . "/../Libs/connect.php"; ?>


<?php require __DIR__ . "/../Views/_header.php"; ?>
<?php require __DIR__ . "/../Views/_navbar.php"; ?>


<div class="container mt-5">

    <div class="row">
        <div class="col-8">
            <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
                <div class="mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6>Teslimat Adresi<h6>
                        </div>
                        <div class="card-body">
                            <form action="ProcessPayment.php" method="post">

                                <div class="row">

                                    <?php
                                    // Kullanıcının adreslerini veritabanından çekelim
                                    $userId = $_SESSION["id"];
                                    $sql = "SELECT * FROM address INNER JOIN address_info ON address.id = address_info.address_id WHERE address_info.user_id = ?";
                                    if ($stmt = mysqli_prepare($connection, $sql)) {
                                        mysqli_stmt_bind_param($stmt, "i", $userId);
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<div class="col-md-4 mb-3">';
                                                echo '<div class="card">';
                                                echo '<div class="card-body">';
                                                echo '<input type="radio" name="selected_address" value="' . $row["id"] . '" required>';
                                                echo '<h5 class="card-title">' . $row["address_title"] . '</h5>';
                                                echo '<p class="card-text">' . $row["full_address"] . '<br>' . $row["city"] . ', ' . $row["district"] . '<br>' . $row["postal_code"] . '</p>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                        } else {
                                            echo "<div class='mb-4'>";
                                            echo "<a href='AddAddress.php' class='btn btn-primary'>Adres Ekle</a>";
                                            echo "</div>";
                                        }

                                        mysqli_stmt_close($stmt);
                                    }
                                    ?>
                                </div>

                            <?php endif; ?>

                            </form>
                        </div>
                    </div>
                </div>

        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h6>Sepetinizdeki Ürünler</h6>
                </div>
                <div class="card-body">
                    <?php
                    // Kullanıcının sepetindeki ürünleri veritabanından çek
                    $userId = $_SESSION["id"];
                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                        $product_ids = array_keys($_SESSION['cart']);
                        $product_ids_string = implode(',', $product_ids);

                        $query = "SELECT * FROM products WHERE id IN ($product_ids_string)";
                        $result = mysqli_query($connection, $query);

                        if (mysqli_num_rows($result) > 0) {
                            $total_price = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $product_id = $row['id'];
                                $product_name = $row['name'];
                                $product_price = $row['price'];
                                $product_quantity = $_SESSION['cart'][$product_id];
                                $total_product_price = $product_price * $product_quantity;
                                $total_price += $total_product_price;
                    ?>
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $product_name; ?></h5>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <p class="card-text">Miktar: <?php echo $product_quantity; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card-body">
                                            <p class="card-text">Fiyat: <?php echo number_format($product_price, 2); ?> TL</p>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        } else {
                            echo '<p>Sepetinizde ürün bulunmamaktadır.</p>';
                        }
                    } else {
                        echo '<p>Sepetinizde ürün bulunmamaktadır.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h6>Kart Bilgileri</h6>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="mb-3">
                            <label for="cardUserName" class="form-label">Kartın Üzerindeki İsim</label>
                            <input type="text" class="form-control" id="cardUserName" name="cardUserName">
                        </div>
                        <div class="mb-3">
                            <label for="cardNumber" class="form-label">Kart Numarası</label>
                            <input type="text" class="form-control" id="cardNumber" name="cardNumber">
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label for="cardMonth" class="form-label">Kart Ay</label>
                                <select id="cardMonth" class="form-select">
                                    <option value="" disabled selected>Ay</option>
                                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                                        <option value="<?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>">
                                            <?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="cardYear" class="form-label">Kart Yıl</label>
                                <select id="cardYear" class="form-select">
                                    <option value="" disabled selected>Yıl</option>
                                    <?php
                                    $currentYear = date("Y");
                                    for ($i = 0; $i < 15; $i++) : ?>
                                        <option value="<?php echo $currentYear + $i; ?>">
                                            <?php echo $currentYear + $i; ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="cardCVV" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cardCVV" name="cardCVV">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="form-check mb-3 text-center">
                                <input class="form-check-input" type="checkbox" id="3DSecureCheck">
                                <label class="form-check-label" for="3DSecureCheck">
                                    3D Secure ile ödeme yapmak istiyorum.
                                </label>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h6>Ödeme Yap</h6>
                </div>
                <div class="card-body">
                    <form action="payment_process.php" method="post">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="acceptTerms" required>
                            <label class="form-check-label" for="acceptTerms">
                                Sözleşme ve formları okudum ve kabul ediyorum.
                            </label>
                        </div>
                        <div class="text-center">
                            <a href="Payment2.php" class="btn" style='background-color: #153448; color:white;'>Ödeme Yap</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<br>
<br>
<br>
<br>
<br>
<br>

<?php include __DIR__ . "/../Views/_scripts.php"; ?>
<?php include __DIR__ . "/../Views/_footer.php"; ?>