<?php
include "db.php";

if(!isset($_GET['id'])) die("No die specified");

$id = intval($_GET['id']);

$sql = "SELECT stocks FROM product WHERE 
product_id = $id";
$result = $conn->query($sql);

if($result->num_rows == 0) die("No Stocks");

$row = $result->fetch_assoc();

$newStocks = $row['stocks'] - 1;

$sql = "UPDATE product SET stocks='$newStocks' WHERE product_id='$id'";

if($conn->query($sql) === TRUE){
    exit();
}
else {
    echo"Error: " . $sql . "<br>" . $conn->error;
}

?>