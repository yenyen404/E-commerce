<?php
$conn = new mysqli("localhost", "root", "", "upload");

if(!$conn){
    die("Connection Error: " . mysqli_connect());
}

?>