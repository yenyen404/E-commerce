<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $stocks = $_POST["stocks"];

    //image
    $product_image = null;

    //if the image is empty
    if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] == 0) {
        $product_image = file_get_contents($_FILES["product_image"]["tmp_name"]);
    }

    if (isset($_POST["add"])) {
        $stnt = $conn->prepare(
            "INSERT INTO product (product_id, product_image, product_name, price, stocks) VALUES (?, ?, ?, ?, ?)"
        );

        $stnt->bind_param("sssss", $product_id, $product_image, $product_name, $price, $stocks);

        if ($stnt->execute()) {
            echo "<script>alert('added successfully');window.location.href='admin.php'</script>";
        } else {
            echo "Error " . $conn->error;
        }
    } elseif (isset($_POST['edit'])) {

        if ($product_image != null) {

            $stnt = $conn->prepare("UPDATE product SET 
    product_image= ?, product_name= ?, price= ?, stocks= ? WHERE product_id= ?"
            );

            $stnt->bind_param("sssss", $product_image, $product_name, $price, $stocks, $product_id);

        } else {
            $stnt = $conn->prepare("UPDATE product SET 
    product_name= ?, price= ?, stocks= ? WHERE product_id= ?"
            );

            $stnt->bind_param("ssss", $product_name, $price, $stocks, $product_id);
        }

        if ($stnt->execute()) {
            echo "<script>alert('Updated successfully');window.location.href='admin.php'</script>";
        } else {
            echo "Error " . $conn->error;
        }

        // delete product
    } elseif(isset($_POST['delete'])){
        
    $sql = "DELETE FROM product WHERE product_id='$product_id'";

    
        if($conn->query($sql) === TRUE){
            echo"<script>alert('Deleted sucessfully!'); window.location.href='admin.php'</script>";
            exit();
         }else{
            echo"Error" . $conn->error;
        }
    

    }
}

$stnt->close();
?>