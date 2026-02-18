<?php
$conn = new mysqli("localhost", "root", "", "my_ecommerce");

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}
?>