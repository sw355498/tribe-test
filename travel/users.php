<?php
require_once("php/pdo_connect_travel.php");
//讀取member裡所有的資料
// $id=2;
// $id=$_GET["id"];
// $stmt=$db_host->prepare("SELECT * FROM member WHERE id=?");

$stmt=$db_host->prepare("SELECT * FROM member");
try{
    $stmt->execute();
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //因id只有一筆資料,用fetch即可
    // $stmt->execute([$id]);
    // $rows=$stmt->fetch();
}catch(PDOException $e){
    echo "讀取資料失敗";
}
//fetchAll 優點可直接轉成關聯式陣列

// var_dump($rows);

//轉成關聯是陣列當api
//用json_encode 方式將關聯式陣列echo出來
echo json_encode($rows);


?>