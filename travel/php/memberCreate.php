<?php
require_once("pdo_connect_travel.php");

$sql="INSERT INTO member(name,account,phone,email,create_time,gender,valid,birth)VALUES(?,?,?,?,?,?,?,?)";
$stmt=$db_host->prepare($sql);
$name=$_POST["name"];
$account=$_POST["account"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$create_time=date('Y-m-d H:i:s');
$gender=$_POST["gender"];
$valid="1";
$birth=$_POST["birth"];

$stmt->execute([$name,$account,$phone,$email,$create_time,$gender,$valid,$birth]);
echo "新資料已建立";

header("location:../member.php")
?>