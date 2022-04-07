<?php
require_once("pdo_connect_travel.php");

if(!isset($_POST["account"])){
    echo "請循正常管道進入";
    header("location:login.php");
    exit();
}
$account=$_POST["account"];
$password=$_POST["password"];

//帶入sql
$stmt=$db_host->prepare("SELECT * FROM member WHERE account = ? AND password=?AND valid=1" );

try{
    $stmt->execute([$account,$password]);
    //限制登入錯誤次數
    $loginStatus=$stmt->rowCount();
    if($loginStatus===0){
        if(isset($_SESSION["error"])){
            $times=$_SESSION["error"]["times"]+1;
        }else{
            $times=1;
        }
        $dataError=array(
            "message"=>"您的帳號密碼錯誤",
            "times"=>$times
        );
        //$dataError存入session
        $_SESSION["error"]=$dataError;
        header("location:login.php");
    }else{
        while($row=$stmt->fetch()){
            //存入session的資料
             $dataUser=array(
                 "name"=>$row["name"],
                 "account"=>$row["account"],
                 "email"=>$row["email"],
                " phone"=>$row["phone"]
             );
             unset($_SESSION["error"]);
             $_SESSION["member"]=$dataUser;
             echo"使用者登入完成";
           
         }
    }
   
}catch(PDOException $e){
    echo "資料庫連接失敗<br>";
    echo "Error:".$e->getMessage()."<br>";
    exit;
}
?>