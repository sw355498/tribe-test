<?php
require_once("pdo_connect_travel.php");
$sql="UPDATE product SET name=?, price=?, number=?, viewpoint_id=?,topic_id=?, itinerary=?, guide_id=?, content=?, status=? WHERE id= ?";
$stmt=$db_host->prepare($sql);

$id=$_POST["id"];
$name=$_POST["name"];
$price=$_POST["price"];
$number=$_POST["number"];
if(isset($_POST["viewpoint_id"])){
$viewpoint_id=$_POST["viewpoint_id"];

/* 清除陣列空值 */
$viewpoint_id=array_filter($viewpoint_id);

/* 陣列用","zp 分隔轉換成字串 */
$viewpoint_id_str=implode(",",$viewpoint_id);
}
$itinerary=$_POST["itinerary"];
$topic_id=$_POST["topic_id"];
$guide_id=$_POST["guide_id"];
$content=$_POST["content"];
$status=$_POST["status"];


try{
    $stmt->execute([$name, $price,$number,$viewpoint_id_str,$topic_id,$itinerary,$guide_id,$content,$status, $id]);
    echo "資料修改完成";


}catch(PDOException $e){
    echo "資料庫修改失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

$db_host=null;
echo "<script> alert('更新成功');parent.location.href='../product_list.php'; </script>";
// header('location: ../product.php?id='.$id);

?>