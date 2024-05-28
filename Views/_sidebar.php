<?php include "Libs/variables.php"; ?>


<h3 class="mb-4"><?php echo "Kategoriler" ?></h3>

<div class="container">
    

<ul class="list-group">

<?php foreach($categories as $category):?>
<li class= "list-group-item"><?php echo $category['categoryName'];?></li>

<?php endforeach ;?>

</ul>


</div>