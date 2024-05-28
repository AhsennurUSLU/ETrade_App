<?php require "../config.php"  ?>
<?php require "../Views/_header.php"  ?>
<?php require "../Views/_navbar.php"  ?>





<div class="container mt-5">
    <h1 class="mb-4">Sepetim</h1>

   
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Ürün Adı</th>
                <th>Fiyat</th>
                <th>Miktar</th>
                <th>Toplam</th>
                <th>İşlem</th>
            </tr>
            </thead>
            <tbody>
         
         
           
                <tr>
                    <td></td>
                    <td> TL</td>
                    <td></td>
                    <td> TL</td>
                    <td>
                        <a href="cart.php?action=remove&product_id=<?php echo $product_id; ?>" class="btn btn-danger btn-sm">Sil</a>
                    </td>
                </tr>
           
            </tbody>
        </table>
        <div class="text-right">
            <h4>Genel Toplam:  TL</h4>
            <a href="cart.php?action=clear" class="btn btn-warning">Sepeti Boşalt</a>
            <a href="checkout.php" class="btn btn-success">Satın Al</a>
        </div>
   
        <div class="alert alert-info">Sepetinizde ürün bulunmamaktadır.</div>
    

    <a href="index.php" class="btn btn-primary mt-3">Alışverişe Devam Et</a>
</div>

<?php include "../Views/_scripts.php"  ?>
<?php include "../Views/_footer.php"; ?>