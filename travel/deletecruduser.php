<?php
require_once "php/db_connect_travel.php";

$id=$_GET["id"];

$sql="DELETE FROM order_detail WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "資料表 users 修改完成";
} else {
    echo "修改資料表錯誤: " . $conn->error;
}


header('location: cruduser-list.php');
?>