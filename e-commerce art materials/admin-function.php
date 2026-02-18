<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // get text input
    $product_id = $_POST["product_id"];
    $product_image = $_POST["product_image"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $stocks = $_POST["stocks"];

 

    //add button
    if (isset($_POST['add'])) {

        $sql = "INSERT INTO product (product_id, product_image, product_name, price, stocks) 
        VALUES 
        ('$product_id', '$product_image', '$product_name', '$price', '$stocks')";


        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('added successfully'); window.location.href='admin.php'</script>";
            exit();
        } else {
            echo "Error " . $conn->error;
        }
    }

    // edit button
    elseif (isset($_POST['edit'])) {

        $sql = "UPDATE product SET 
        product_name='$product_name',  
        product_image='$product_image',
        price='$price', 
        stocks='$stocks' 
        WHERE product_id='$product_id'";


        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Edit successfully!'); window.location.href='admin.php'</script>";
            exit();
        } else {
            echo "Error" . $conn->error;
        }

    }

    // delete button to delete product
    elseif (isset($_POST['delete'])) {

        $sql = "DELETE FROM product WHERE product_id ='$product_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Deleted sucessfully!'); window.location.href='admin.php'</script>";
            exit();
        } else {
            echo "Error" . $conn->error;
        }
    }

}



$conn->close();
?>