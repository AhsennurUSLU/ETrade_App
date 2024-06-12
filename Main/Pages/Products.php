<?php include __DIR__ . "/../../config.php"; ?>
<?php include __DIR__ . "/../Libs/connect.php"; ?>

<?php
// Gelen kategori ID'sini alın
$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

// Kategoriye ait ürünleri çekin
$query = "SELECT 
            c.id as category_id, 
            c.name as category_name, 
            p.id as product_id, 
            p.name as product_name, 
            p.description as product_description,
            p.price as product_price,
            p.image as product_image,
            p.stock as product_stock,
            p.isActive as product_isActive,
            p.createdAt as product_createdAt
          FROM 
            category_product cp 
          INNER JOIN 
            categories c ON cp.category_id = c.id 
          INNER JOIN 
            products p ON cp.product_id = p.id 
          WHERE 
            cp.category_id = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "i", $category_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
mysqli_close($connection);
?>

<?php require __DIR__ . "/../Views/_header.php"; ?>
<?php require __DIR__ . "/../Views/_navbar.php"; ?>

<style>
    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .card {
        height: 100%;
    }
    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .card-footer {
        display: flex;
        justify-content: flex-end;
    }
    .no-decoration {
    text-decoration: none;
    color: inherit; /* Varsayılan metin rengini kullan */
}

.no-decoration:hover {
    text-decoration: none;
}

</style>

<div class="container mt-5">
    <h3>Ürünler</h3>
    <div class="row">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $image = $row['product_image'];
                $name = $row['product_name'];
                $price = $row['product_price'];
                echo "<div class='col-md-3 mb-4'>";
                echo "  <div class='card'>";
                echo   "<a href='ProductDetails.php?product_id=$product_id' class='no-decoration'>";
                echo "      <img src='$image' class='card-img-top' alt='$name'>";
                echo "      <div class='card-body'>";
                echo "          <h5 class='card-title'>$name</h5>";
                echo "          <p class='card-text'>₺$price</p>";
                echo "      </div>";
                echo "      <div class='card-footer'>";
                echo "          <form class='add-to-cart-form' method='POST' action=''>";
                echo "              <input type='hidden' name='product_id' value='$product_id'>";
                echo "              <button type='submit' name='add_to_cart' class='btn' style='background-color: #3C5B6F; color:white;'>Sepete Ekle</button>";
                echo "          </form>";
                echo "      </div>";
                echo "</a>";
                echo "  </div>";
                echo "</div>";
            }
        } else {
            echo "<p>Ürün bulunamadı.</p>";
        }
        ?>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.add-to-cart-form');

    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const xhr = new XMLHttpRequest();
            
            xhr.open('POST', 'add_to_cart.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    const cartCount = document.querySelector('.navbar .badge');
                    
                    if (response.status === 'success') {
                        cartCount.textContent = response.cart_count;
                    }

                    // Bilgilendirme alerti
                    alert(response.message);
                }
            };
            
            xhr.send(formData);
        });
    });
});
</script>

<?php include __DIR__ . "/../Views/_scripts.php"; ?>
<?php include __DIR__ . "/../Views/_footer.php"; ?>
