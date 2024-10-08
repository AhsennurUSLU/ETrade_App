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

if (!function_exists('getMessageById')) {
function getMessageById($id) {
    include "../../Main/Libs/connect.php";

    $sql = "SELECT * FROM messages WHERE id = ?";
    if ($stmt = mysqli_prepare($connection, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result && mysqli_num_rows($result) > 0) {
          //  return mysqli_fetch_assoc($result);
          return $result;
        } else {
            return null;
        }
    }
    return null;
}

}

?>





