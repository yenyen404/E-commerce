    <?php
include "db.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // get text input
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $stocks = $_POST["stocks"];

    // img var
    $imagePath = "";
    // img info
    if(!empty($_FILES["product_image"]["name"])){
     $imageName = $_FILES["product_image"]["name"];
     $imageTmp = $_FILES["product_image"]["tmp_name"];

    $uploadDir = "uploads/";
    $imagePath = $uploadDir . time() . "_" . basename($imageName);

    // create folder if not exist
    if(!is_dir($uploadDir)){
        mkdir($uploadDir, 0777, true);
    }

    // move image to folder
    move_uploaded_file($imageTmp, $imagePath);


    }

 //add button
    if(isset($_POST['add'])){

        $sql = "INSERT INTO product (product_id, product_image,product_name, price, stocks) 
        VALUES 
        ('$product_id', '$imagePath', '$product_name', '$price', '$stocks')";

          
        if($conn->query($sql) === TRUE){
            echo "<script>alert('added successfully'); window.location.href='admin.php'</script>";
            exit();
        }
        else{
            echo"Error " . $conn->error;
        }
    }

    // edit button
    elseif(isset($_POST['edit'])){

        if($imagePath != ""){

// new image uploaded
        $sql = "UPDATE product SET 
        product_name='$product_name',  
        product_image='$imagePath',
        price='$price', 
        stocks='$stocks' 
        WHERE product_id='$product_id'";

        }else{

         //if no new image -> keep old img    
        $sql = "UPDATE product SET 
        product_name='$product_name',  
        price='$price', 
        stocks='$stocks' 
        WHERE product_id='$product_id'";
        
        }

        if($conn->query($sql) === TRUE){
            echo "<script>alert('Edit successfully!'); window.location.href='admin.php'</script>";
            exit();
        }
        else{
            echo"Error" . $conn->error;
        }
       
    }

    // delete button to delete product
    elseif(isset($_POST['delete'])){


// delete img file first
        $result = $conn->query(
            "SELECT product_image FROM product WHERE product_id='$product_id'"
        );

        $row = $result->fetch_assoc();

        if(file_exists($row["product_image"])){
            unlink($row["product_image"]);
        }

        $sql = "DELETE FROM product WHERE product_id ='$product_id'";

        if($conn->query($sql) === TRUE){
            echo"<script>alert('Deleted sucessfully!'); window.location.href='admin.php'</script>";
            exit();
         }else{
            echo"Error" . $conn->error;
        }
    }

       }


    
$conn->close();
?>