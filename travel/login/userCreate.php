<?php
require_once("pdo_connect_travel.php");

if(isset($_POST["account"])){
    $account=$_POST["account"];
}else{
    echo "沒有帶資料";
    exit;
}

$sql="INSERT INTO user (account,password,valid) VALUES (?,?,?)";
$stmt=$db_host->prepare($sql);
$account=$_POST["account"];
$password =$_POST["password"];
$valid=1;


try{
    $stmt->execute([$account, $password,$valid]);
//   header("location:transfer.php");

}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}
$db_host=null;

header("location:login.php")
?>





