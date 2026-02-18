<?php 
include "db.php";

// handle form submission
if($_SERVER["REQUEST_METHOD"] == "POST"){
$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$total_order = $_POST['total_order'];
$total_price = $_POST['total_price'];


// Check current stock
$sql_stock = "SELECT stocks FROM product WHERE product_id='$product_id'"; //sql command to get the stock from dbtable
$result_stock = mysqli_query($conn, $sql_stock); //execute sql command
$row_stock = mysqli_fetch_assoc($result_stock); //fetch the stock value
$current_stock = $row_stock['stocks']; //declare current stock variable

if($total_order > $current_stock){
    echo"<script>alert('order exceeeds available stock! Only {$current_stock} left.');window.location.href='index.php';</script>";
} else{
       
    //order id
        $next_order_id = 1; 
        $order_result = $conn->query("SELECT MAX(order_id) AS order_id FROM orders");
            if($order_result && $sql_order_id = $order_result->fetch_assoc()){
                $next_order_id = $sql_order_id['order_id'] + 1;
            }
            
    // insert order
        $sql_insert = "INSERT INTO orders (order_id, product_id, product_name, price, total_order, total_price) VALUE ('$next_order_id','$product_id', '$product_name', '$price', '$total_order', '$total_price')";

        if(mysqli_query($conn, $sql_insert)){
            // deduct stock
            $new_stock = $current_stock - $total_order;

            $sql_update = "UPDATE product SET stocks='$new_stock' WHERE product_id='$product_id'";
            mysqli_query($conn, $sql_update);

             echo"<script>alert('Order placed successfully!');window.location.href='index.php';</script>";

        } else{
             echo"<script>alert('error:' . mysqli_error($conn));</script>";
        }
}

// $order_id = 1;
// $sql_order_id = "SELECT order_id FROM order WHERE order_id='$order_id'";
// $result_order_id = mysqli_query($conn, $sql)

}
?>