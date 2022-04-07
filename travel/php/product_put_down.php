<?php
require_once("pdo_connect_travel.php");

$id=$_GET["id"];

// $sql="DELETE product WHERE id='$id'";
$sql="UPDATE product SET status=0 WHERE id='$id'";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute();
    $row=$stmt->fetchALL(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}





// header('location: ../product_list.php');
echo "<script> alert('下架成功');parent.location.href='../product_list.php'; </script>";
?>