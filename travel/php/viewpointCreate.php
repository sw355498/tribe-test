<?php
require_once("pdo_connect_travel.php");



//其他資訊上傳
// if(isset($_POST["submit"])){

    $name=$_POST["name"];
    $intro=$_POST["intro"];
    $review=$_POST["review"];
    $area_id=$_POST["area"];
    $topic_id=$_POST["topic"];
    $valid=1;

    $sql="INSERT INTO viewpoint (name, intro, review, area_id, topic_id, valid) VALUES (?,?,?,?,?,?)";

    $stmt=$db_host->prepare($sql);

try{
    $stmt->execute([$name,$intro,$review,$area_id,$topic_id,$valid]);
    $last_id=$db_host->lastInsertId();
    echo" <script> alert ('新資料建立成功!');history.go(-2) ;</script>";

}catch(PDOException $e){
    echo"資料庫連結失敗<br>";
    echo"Eroor:".$e->getMessage()."<br>";
    exit;

}
// }




//路徑../img/pic/
//圖片上傳
$fileCount=count($_FILES['file']['name']);

for($i=0; $i<$fileCount; $i++){
if($_FILES['file']["error"][$i]==0){  
    if(move_uploaded_file($_FILES['file']["tmp_name"][$i],  "../img/pic/" .$_FILES["file"]["name"][$i])){
        // echo"圖片上傳成功";
    }else{
        echo "圖片上傳失敗";
    }

}

$viewpoint_id=$last_id;
$file_name=$_FILES['file']['name'][$i];
$sqlImg="INSERT INTO viewpoint_img (img_src,viewpoint_id) VALUES (?, ?) ";
$stmtImg=$db_host->prepare($sqlImg);


try{
    $stmtImg->execute([$file_name, $viewpoint_id]);
    // echo "新資料已建立";
//     echo" <script> alert ('新資料建立成功!'); location.href='".$_SERVER["HTTP_REFERER"]."';
//    </script>"; 

}catch(PDOException $e){
    echo"資料庫連結失敗<br>";
    echo"Eroor:".$e->getMessage()."<br>";
   

}
};

// echo $_SERVER["HTTP_REFERER"].$_SERVER["QUERY_STRING"];
// $p=$_SERVER["HTTP_REFERER"].$_SERVER["QUERY_STRING"];

// //    window.history.go(-); 
// header("Refresh:0 ; URL=$p ");


?>