<?php
require_once("pdo_connect_travel.php");


$sql="INSERT INTO product (name, price, number, viewpoint_id, itinerary,topic_id, guide_id ,content,create_time) VALUES (?,?,?,?,?,?,?,?,?)";
$stmt=$db_host->prepare($sql);

$name=$_POST["name"];
$price=$_POST["price"];
$number=$_POST["number"];
$viewpoint_id=$_POST["viewpoint_id"];
$itinerary=$_POST["itinerary"];
$topic=$_POST["topic"];
$guide_id=$_POST["guide_id"];
$content=$_POST["content"];
$create_time=date('Y-m-d H:i:s');

/* 清除陣列空值 */
$viewpoint_id=array_filter($viewpoint_id);

/* 陣列用","zp 分隔轉換成字串 */
$viewpoint_id_str=implode(",",$viewpoint_id);

try{
    $stmt->execute([$name, $price, $number, $viewpoint_id_str, $itinerary,$topic, $guide_id,$content,$create_time]);
    echo "新資料已建立";

}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}
$db_host=null; /* 關閉資料庫連結 */

// header('location: ../product_list.php');
echo "<script> alert('新增成功');parent.location.href='../product_list.php'; </script>";
?>