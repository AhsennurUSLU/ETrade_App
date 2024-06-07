<?php
require "../Aconfig.php"  ;
include "../../Main/Libs/connect.php";


$sql = "SELECT id, name, email, subject, message, createdAt FROM messages ORDER BY createdAt DESC";
$result = $connection->query($sql);

require '../Views/_Aheader.php';
include "../Views/_Asidebar.php" ;
echo "<div class='content'>";
require '../Views/_Anavbar.php';


?>
  <br>
        <br>
        <br>
       
<div class="container">
 <h6 class="mb-4">Gelen Mesajlar</h6>
            <div class="table-responsive">
                <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ad</th>
                <th scope="col">E-posta</th>
                <th scope="col">Konu</th>
                <th scope="col">Mesaj</th>
                <th scope="col">Tarih</th>
                <th scope="col">İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <?php $id = $row['id'] ; ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['message']; ?></td>
                        <td><?php echo $row['createdAt']; ?></td>
                        <td><a class='btn btn-light' type='submit' name='displayMessage' href="DisplayMessage.php?id=<?php echo $id ;?>" >Görüntüle</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Hiç mesaj bulunmamaktadır.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</div>
<?php
$connection->close();

require '../Views/_Ascripts.php';
