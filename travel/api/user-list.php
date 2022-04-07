<?php
require_once(".../../travel_connect.php");

// $stmt=$db_host->prepare("SELECT * FROM users");
$stmt=$db_host->prepare("SELECT * FROM member");


try{
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($rows);
    // $arr=array();
    // foreach($rows as $value){
    //     // echo "<div>".$value["account"]."</div>";
    //     $userData=array(
    //         "name"=>$value["name"],
    //         "account"=>$value["account"],
    //         "email"=>$value["email"]
    //     );
    //     array_push($arr, $userData);
    // }
    // // print_r($arr);
    // echo json_encode($arr);

}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

?>