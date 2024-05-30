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



?>





