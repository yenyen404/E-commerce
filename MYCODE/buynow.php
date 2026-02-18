<?php
include "db.php";

 if(!isset($_GET['id'])) die("No id specified");

 $id = intval($_GET['id']);

 $sql = "SELECT stocks FROM product WHERE product_id = $id";
 $result = $conn->query($sql);

 if($result->num_rows == 0) die("No Stocks");

 $row = $result->fetch_assoc();

 $newStocks = $row['stocks'] - 1;

 $sql = "UPDATE product SET stocks='$newStocks' WHERE product_id='$id'";

 if($conn->query($sql) === TRUE){
    echo "<script>alert('thank you for buying!!'); window.location.href='home.php'</script>";
    exit();
 }
 else{
    echo "Error: " . $sql . "<br>" . $conn->error;
 }
?>