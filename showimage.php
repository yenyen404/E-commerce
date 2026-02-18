<?php
include "db.php";

if(!isset($_GET['id'])) die("No ID specified.");

$id = intval($_GET['id']); //sanitize input

$sql = "SELECT product_image FROM products WHERE product_id = $id";
$result = $conn->query($sql);

if($result->num_rows == 0) die("No image found.");

$row = $result->fetch_assoc();

//Detect MIME type dynamically
$finfo = finfo_open();
$type = finfo_buffer($finfo, $row['product_image'], FILEINFO_MIME_TYPE);
finfo_close($finfo);

header("Content-type: $type");
echo $row['product_image'];


?>