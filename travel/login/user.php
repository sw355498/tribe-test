抓一人名單
<?php
require_once("pdo_connect_travel.php");

$id=1;
$stmt=$db_host->prepare("SELECT * FROM user WHERE id =:id");

$account="jay";

try{
    $stmt->execute(array(":id"=>$id));
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