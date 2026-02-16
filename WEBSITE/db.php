<?php

$conn = new mysqli("localhost", "root", "", "website");

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

?>