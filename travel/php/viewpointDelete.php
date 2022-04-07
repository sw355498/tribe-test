<?php
require_once("pdo_connect_travel.php");

$id=$_GET["id"];
// echo $id;

$sql="UPDATE viewpoint SET valid=0 WHERE id='$id'";

$stmt=$db_host->prepare($sql);

try{
    $stmt->execute();
    // echo"資料刪除成功,返回上一頁....";
    // echo "<script>alert('資料刪除成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
    echo "<script>alert('資料刪除成功!');location.href=document.referrer;</script>";


}catch(PDOException $e){
    echo"資料庫修改失敗<br>";
    echo"Eroor:".$e->getMessage()."<br>";
    exit;
}
// echo "<script>alert('刪除成功!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>"; 
// $p=$_SERVER["HTTP_REFERER"].$_SERVER["QUERY_STRING"];
// echo $p;
// header("Refresh:3; url=$p");
// return;


?>
