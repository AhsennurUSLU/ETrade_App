<?php require "../Aconfig.php"  ?>

<?php  


include "../../Libs/connect.php";


$categoryName = $categoryDescription = $categoryImage = "";
$categoryName_err = $categoryDescription_err = $categoryImage_err = "";
$isActive = 0;

if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    if(empty(trim($_POST["categoryName"]))){
        $categoryName_err = "Kategori ismi girmeniz zorunlu.";
    } else{
        $categoryName = trim($_POST["categoryName"]);
    }

    if(empty(trim($_POST["categoryDescription"]))){
        $categoryDescription_err = "Kategori açıklaması girmeniz zorunlu.";
    } else{
        $categoryDescription = trim($_POST["categoryDescription"]);
    }

    if(isset($_POST["isActive"]) && $_POST["isActive"] == 'on'){
        $isActive = 1;
    }

    if(isset($_FILES["categoryImage"]) && $_FILES["categoryImage"]["error"] == 0){
        $allowed = ["jpg", "jpeg", "png"];
        $filename = $_FILES["categoryImage"]["name"];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        if(in_array($filetype, $allowed)){
            $categoryImage = "../Assets/uploads/" . basename($filename);
        } else {
            $categoryImage_err = "Lütfen geçerli bir görsel yolu girin.";
        }
    } else {
        switch($_FILES["categoryImage"]["error"]){
            case UPLOAD_ERR_INI_SIZE:
                $categoryImage_err = "Yüklenen dosya, php.ini dosyasında belirtilen 'upload_max_filesize' yönergesini aşıyor.";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $categoryImage_err = "Yüklenen dosya, HTML formunda belirtilen MAX_FILE_SIZE yönergesini aşıyor.";
                break;
            case UPLOAD_ERR_PARTIAL:
                $categoryImage_err = "Dosya kısmen yüklendi.";
                break;
            case UPLOAD_ERR_NO_FILE:
                $categoryImage_err = "Dosya yüklenmedi.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $categoryImage_err = "Geçici klasör eksik.";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $categoryImage_err = "Diske yazma başarısız.";
                break;
            case UPLOAD_ERR_EXTENSION:
                $categoryImage_err = "PHP uzantısı dosya yüklemeyi durdurdu.";
                break;
            default:
                $categoryImage_err = "Bilinmeyen bir hata oluştu.";
                break;
        }
       // $categoryImage_err = "Lütfen resim yükleyin.";
    }


    
    if(empty($categoryName_err) && empty($categoryDescription_err) && empty($categoryImage_err)){
      
        if(move_uploaded_file($_FILES["categoryImage"]["tmp_name"], $categoryImage)){
      
            $sql = "INSERT INTO categories (name, description, image,isActive) VALUES (?, ?, ?,?)";

            if($stmt = mysqli_prepare($connection, $sql)){
            
                mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_description, $param_image, $param_isActive);

              
                $param_name = $categoryName;
                $param_description = $categoryDescription;
                $param_image = $categoryImage;
                $param_isActive = $isActive;

                if(mysqli_stmt_execute($stmt)){
                 
                    header("location: CategoryList.php");
                } else{
                    echo "Ters giden bir şeyler var. Lütfen daha sonra tekrar deneyiniz.";
                }

             
                mysqli_stmt_close($stmt);
            }
        } else {
            echo "Resim yüklerken hata oluştu.";
        }
    }

    mysqli_close($connection);
}
?>







<?php include "../Views/_Aheader.php" ?>
<div class="container-fluid position-relative bg-white d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <?php include "../Views/_Asidebar.php" ?>
    <div class="content">
        <?php include "../Views/_Anavbar.php" ?>

        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="container">

            <div class="col-6 ">
                <div class="card p-4">

                    <div class="card-body p-3">
                        <h6 class="mb-4">Kategori Ekle</h6>
                        <form action="AddCategory.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3 ">
                                <label for="categoryName" class="form-label">Kategori Adı</label>
                                <input type="text" class="form-control <?php echo (!empty($categoryName_err)) ? 'is-invalid':'' ?>" id="categoryName" value="<?php echo $categoryName;?>" name="categoryName" >
                                <span class="invalid-feedback"><?php echo $categoryName_err?></span>
                            </div>
                            <div class="mb-3">
                                <label for="categoryDescription" class="form-label">Açıklama</label>
                                <input type="text" class="form-control <?php echo (!empty($categoryDescription_err)) ? 'is-invalid':'' ?>" id="categoryDescription" value="<?php echo $categoryDescription;?>" name="categoryDescription">
                                <span class="invalid-feedback"><?php echo $categoryDescription_err?></span>
                           
                            </div>
                            <div class="mb-3">
                                <label for="categoryImage" class="form-label">Resim Yükle</label>
                                <input class="form-control <?php echo (!empty($categoryImage_err)) ? 'is-invalid' : '' ?>" type="file" id="categoryImage" value="<?php echo $categoryImage; ?>" name="categoryImage">
                                <span class="invalid-feedback"><?php echo $categoryImage_err ?></span>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="isActive" name="isActive">
                                <label class="form-check-label" for="isActive">Aktif</label>
                            </div>
                            <button type="submit" name="categoryAdd" class="btn btn-primary">Kaydet</button>
                        </form>

                    </div>
                </div>
            </div>


        </div>


        <br>
        <br>
        <br>
        <br>
        <br>




    </div>


</div>
<?php include "../Views/_Ascripts.php" ?>