<?php
require_once "../db_connect_travel.php";
if (isset($_GET["id"])) {
    // $name = $_POST["name"];
    // echo $name;
} else {
    echo "沒有帶資料";
    exit;
}    

// $product_name = strip_tags($_POST['product_name']);
// $product_name = $_GET['product_name'];
// $user_id = $_GET["user_id"];
$now = date('Y-m-d H:i:s');
$name = $_GET["name"];
$number=$_GET["number"];
$date_start=$_GET["date_start"];
$date_end=$_GET["date_end"];
$id = $_GET["id"];
$others = $_GET["others"];
$currency_id = $_GET["currency_id"];


// $product_order=$sql("select id+60 from product_order ");


// $sql="INSERT INTO product_order (product_name,buy_time,name,vaild,product_order) 
//     VALUES ('$product_name','$now','$name','1','$product_order')";
// echo "新增資料完成";

$sql = "INSERT INTO `order_detail`(`buy_time`, `name`,`number`, `status`, `date_start`, `date_end`, `product_id`,`others`,`currency_id`) VALUES ( '$now','$name','$number','1','$date_start','$date_end','$id','$others','$currency_id')";

// $sql = "INSERT INTO `order_detail`(`price`,`total`) select price,(price)*($number) from product where product_name=$product_name ";


if ($conn->query($sql) === TRUE) {
    echo "新增資料完成";
} else {
    echo "新增資料錯誤: " . $conn->error;
}

// $conn->close();

header('location: cruduser-list.php');



?>