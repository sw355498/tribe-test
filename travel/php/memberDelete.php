<?php

require_once("pdo_connect_travel.php");

$id=$_GET["id"];

$sql="DELETE FROM member WHERE id='$id'";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute();
    $row=$stmt->fetchALL(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

echo "<script> alert('刪除成功');parent.location.href='../member.php'; </script>";



?>