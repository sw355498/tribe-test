<?php
require_once("pdo_connect_travel.php");
$sql = "UPDATE member SET name=?,account=?,phone=? ,email=?,gender=?, birth=?,coupon=?,points=?  WHERE id=?";
$stmt = $db_host->prepare($sql);
$id = $_POST["id"];
$name =$_POST["name"];
$account =$_POST["account"];
$phone =$_POST["phone"];
$email = $_POST["email"];
$gender = $_POST["gender"];
$birth = $_POST["birth"];
$coupon = $_POST["coupon"];
$points = $_POST["points"];

try {
    $stmt->execute(
        [$name,$account, $phone, $email, $gender, $birth, $coupon, $points,$id]
    );
    echo "<script> alert('資料更改完成');parent.location.href='../member.php'; </script>";

    //catch pdo的錯誤
} catch (PDOException $e) {
    echo "資料修改失敗<br>";
    echo "Error: " . $e->getMessage() . "<br>";
    exit;
}

// $db_host = null;


?>

