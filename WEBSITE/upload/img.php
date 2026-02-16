<?php
include "db.php";

if(!isset($_GET["id"])) die("no id specified");

$id = intval($_GET["id"]);

$sql = "SELECT filedata FROM files WHERE id=$id";
$result = $conn->query($sql);

if($result->num_rows == 0) die("NO FILE FOUND");

$row = $result->fetch_assoc();

$finfo = finfo_open();
$type = finfo_buffer($finfo, $row['filedata'], FILEINFO_MIME_TYPE);
finfo_close($finfo);

header("Content-type:$type");
echo $row['filedata'];

?>