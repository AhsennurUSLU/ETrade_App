<?php 

// Kategori ID'si getirme

function getCategoryById(int $categoryId) {
    include "../../Main/Libs/connect.php";

    $query = "SELECT * FROM categories WHERE id='$categoryId'";
    $result = mysqli_query($connection,$query);
    mysqli_close($connection);
    return $result;
}

// Kategori Düzenleme İşlemi

function editCategory(int $id, string $categoryName,string $categoryDescription,string $categoryImage, int $isActive) {
    include "../../Main/Libs/connect.php";

    $query = "UPDATE categories SET name='$categoryName',description =' $categoryDescription',image ='$categoryImage', isActive=$isActive WHERE id=$id";
    $result = mysqli_query($connection,$query);
    echo mysqli_error($connection);

    return $result;
}


// Kategori Silme İşlemi

function deleteCategory(int $id) {
    include "../../Main/Libs/connect.php";
    
    $query = "DELETE FROM categories WHERE id=$id";
    $result = mysqli_query($connection,$query);
    return $result;
}

// Veri tabanında bulunan kategori sayısını getirme


// function getCategoryCount() {
//     include "../../Main/Libs/connect.php"; 

//     $query = "SELECT COUNT(*) AS total FROM categories";
//     $result = mysqli_query($connection, $query);

//     if ($result) {
//         $row = mysqli_fetch_assoc($result);
//         $total_categories = $row['total'];
        
//         mysqli_close($connection);
//         return $total_categories;
//     } else {
//         echo "Kayıt sayısı alınamadı: " . mysqli_error($connection);
//         mysqli_close($connection);
//         return false; 
//     }
// }


// Ürün ID'si getirme

// function getProductById(int $productId) {
//     include "../../Main/Libs/connect.php";

//     $query = "SELECT * FROM products WHERE id='$productId'";
//     $result = mysqli_query($connection,$query);
//     mysqli_close($connection);
//     return $result;
// }



function getCategoryProductById(int $id){
    include "../../Main/Libs/connect.php";


   
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
 FROM category_product cp 
 INNER JOIN categories c ON cp.category_id = c.id 
 INNER JOIN products p ON cp.product_id = p.id 
 WHERE cp.product_id = $id";
    $result = mysqli_query($connection,$query);
    mysqli_close($connection);
    return $result;
}


// Ürün silme işlemi

function deleteProduct($product_id) {
    include "../../Main/Libs/connect.php";


    $query1 = "DELETE FROM category_product WHERE product_id = $product_id";
    $query2 = "DELETE FROM products WHERE id = $product_id";

    $result1 = mysqli_query($connection, $query1);
    $result2 = mysqli_query($connection, $query2);

  
    if ($result1 && $result2) {
        return true;
    } else {
        return false;
    }
}



function getAddressUserById(int $id){
  include "../../Main/Libs/connect.php";


 
 $query = "SELECT 
 u.id as user_id,
 u.email as email, 
 a.id as address_id, 
 a.address_title as address_title, 
 a.city as city,
 a.district as district,
 a.neighborhood as neighborhood,
 a.postal_code as postal_code,
 a.full_address as full_address
FROM address_info ai
INNER JOIN users u ON ai.user_id = u.id 
INNER JOIN address a ON ai.address_id = a.id 
WHERE ai.address_id = $id";

$result = mysqli_query($connection,$query);
mysqli_close($connection);
return $result;
}





?>





