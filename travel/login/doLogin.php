<?php
require_once("pdo_connect_travel.php");

if(!isset($_POST["account"])){
    echo "請循正常管道進入";
    header("location:login.php");
    exit();
}

$account=$_POST["account"];
$password=$_POST["password"];
$stmt=$db_host->prepare("SELECT * FROM user WHERE account = ? AND password=?AND valid=1");

try{
    $stmt->execute([$account,$password]);
    $loginStatus=$stmt->rowCount();
  
    if($loginStatus===0){
        if(isset($_SESSION["error"])){
            $times=$_SESSION["error"]["times"]+1;
        }else{
            $times=1;
        }
        $dataError=array(
            "message"=>"您的帳號或密碼錯誤",
            "times"=>$times
        );
            $_SESSION["error"]=$dataError;
            header("location:login.php");
    }else{ 
        while($row=$stmt->fetch()){
        // echo $row["account"].". ".$row["name"];
        // echo "<br>";
        // 選擇要顯示項目
        $dataUser=array(
            "name"=>$row["name"],
            "account"=>$row["account"],
        );
        unset($_SESSION["error"]);
        $_SESSION["user"]=$dataUser;
        header("location:../member.php");
    }    
}

   
}catch(PDOException $e){
    echo "資料庫連接失敗<br>";
    echo "error: ".$e->getMessage()."<br>";
    exit;
}
