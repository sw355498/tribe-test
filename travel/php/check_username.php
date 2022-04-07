<?php
require_once("pdo_connect_travel.php");

$account=$_POST["account"];
$sql="SELECT account FROM user WHERE account = ?";
$stmt=$db_host->prepare($sql);
$stmt->execute([$account]);

try{
    $count=$stmt->rowCount();
    $data=array(
        "status"=>1,
        "count"=> $count
    );
    echo json_encode($data);

}catch(PDOException $e){
    // echo "資料庫連結失敗<br>";
    // echo "Eroor: ".$e->getMessage(). "<br>";
    $data=array(
        "staus"=>0,
        "message"=> $$e->getMessage()
    );
    echo json_encode($data);
    exit;
}

?>
