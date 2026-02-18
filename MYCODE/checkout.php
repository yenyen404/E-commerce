<?php 
include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

// check stock first
foreach($data as $item){
    $id = (int)$item["id"];
    $qty = (int)$item["quantity"];

    //check stock
    $check = $conn->query("SELECT stocks FROM product WHERE product_id = $id");
    $row = $check->fetch_assoc();

    if($row["stocks"] < $qty){
    echo json_encode([
    "success" => false,
    "message" => "Not enough stock for product ID $id"
    ]);
        exit;
}
}

// reduce stock
foreach($data as $item){
    $id = (int)$item["id"];
    $qty = (int)$item["quantity"];

    $conn->query(
        "UPDATE product
        SET stocks = stocks - $qty
        WHERE product_id = $id"
    );
}
// success response
 echo json_encode([
    "success" => true,
    "message" => "Purchase successful!"
    ]); 


?>