<?=
$servername = "localhost";
$username = "";
$password = "";
$dbname = "travel_db";

date_default_timezone_set("Asia/Taipei");

try{
    $db_host = new PDO(
        "mysql:host={$servername}; dbname={$dbname};charset=utf8",
        $username, $password
    );
}
catch (PDOException $e){
    echo "資料庫連線失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}

//echo "資料庫連線成功";

// $db_host = null; /* 關閉資料庫連線 */
?>