<?php
include "db.php";

if(!isset($_GET["product_id"])) die("no id specified");

$id = intval($_GET["product_id"]);

$sql = "SELECT product_image FROM product where product_id=$id";
$result = $conn->query($sql);

if($result->num_rows == 0) die("NO IMAGE FOUND");

$row = $result->fetch_assoc();

$finfo = finfo_open();
$type = finfo_buffer($finfo, $row['product_image'], FILEINFO_MIME_TYPE);
finfo_close($finfo);

header("Content-type:$type");
echo $row['product_image'];
?>