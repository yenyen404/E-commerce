<?php
$conn = new mysqli("localhost", "root", "", "market");

if(!$conn){
    die("CONNECTION FAILED:" . mysqli_connect_error());
}
?>