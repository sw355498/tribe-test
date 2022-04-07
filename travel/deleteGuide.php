<?php
require_once("php/pdo_connect_travel.php");

// echo $id;
//刪除需有給使用者確認的動作(跳出視窗)
// $sql="DELETE FROM guide WHERE id='$id'";

// if ($conn->query($sql) === TRUE) {
//     echo "刪除資料完成";

// } else {
//     echo "刪除資料錯誤: " . $conn->error;
// };

$id=$_GET["id"];
$stmt=$db_host->prepare("UPDATE guide SET valid=0 WHERE id = ?");
$stmt->execute([$id]);
try{    
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo" <script> alert ('資料刪除成功!');</script>";
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}
// if ($conn->query($sql) === TRUE) {
//         echo "刪除資料完成";
    
//     } else {
//         echo "刪除資料錯誤: " . $conn->error;
//     };
// header('location: guide-list.php')

// $id=$_POST["id"];
// $sql="SELECT name, account, email, phone FROM users WHERE id = ?";
// $stmt=$db_host->prepare($sql);
// $stmt->execute([$id]);

// try{
//     // while($row=$stmt->fetch()){
//     //     echo $row["id"].". ".$row["name"].": ".$row["email"];
//     //     echo "<br>";
//     // }
//     //若多筆資料用fetchALL
//     $row=$stmt->fetch();
//     // var_dump($row);
//     echo json_encode($row);

// }catch(PDOException $e){
//     echo "資料庫連結失敗<br>";
//     echo "Eroor: ".$e->getMessage(). "<br>";
//     exit;
// }

header("Refresh:0 ; URL= guide-list.php ");
?>