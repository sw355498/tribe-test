抓全部名單

<?php
require_once("pdo_connect_travel.php");

$stmt=$db_host->prepare("SELECT * FROM user");

$account="jay";

try{
    $stmt->execute(array());
    while($row=$stmt->fetch()){
        echo $row["id"].": ".$row["name"];
        echo "<br>";
    }

}catch(PDOException $e){
    echo "資料庫連接失敗<br>";
    echo "error: ".$e->getMessage()."<br>";
    exit;
}

$db_host=null;

?>