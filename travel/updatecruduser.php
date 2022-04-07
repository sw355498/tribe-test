<?php
require_once "../db_connect_travel.php";

$number=$_POST["number"];
$id=$_POST["id"];
$others = $_POST["others"];

$sql="UPDATE order_detail SET number='$number',others='$others' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "修改資料完成";
    
} else {
    echo "修改資料錯誤: " . $conn->error;
}

// header('location: user-list.php');
header('location: cruduser-list.php');



?>