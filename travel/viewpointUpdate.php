<?php
require_once("pdo_connect_travel.php");

// if(isset($_POST["update"])){

    $id=$_POST["id"];
    $name=$_POST["name"];
    $area_id=$_POST["area"];
    $topic_id=$_POST["topic"];
    $intro=$_POST["intro"];
    $review=$_POST["review"];

    $sql="UPDATE viewpoint SET 
     name='$name',area_id='$area_id', topic_id='$topic_id', intro='$intro', review='$review' 
     WHERE id='$id'";

    $stmt=$db_host->prepare($sql);

try{
   $stmt->execute();
   echo" <script> alert ('資料編輯成功!');history.go(-2);</script>";

}catch(PDOException $e){
    echo"資料更新失敗<br>";
    echo"Eroor:".$e->getMessage()."<br>";
   
}


//圖片更新
$old_img=$_POST["old_img"];
$fileCount=count($_FILES['file']['name']);

for($i=0; $i<$fileCount; $i++){
   

if($_FILES['file']['error'][$i]==0){
    $filename=$_FILES['file']['name'][$i];

    $sqlImg="INSERT INTO viewpoint_img (img_src, viewpoint_id) VALUES (?, ?)";
    $stmtImg=$db_host->prepare($sqlImg);
    $stmtImg->execute([$filename, $id]);

    if(move_uploaded_file($_FILES['file']["tmp_name"][$i],  "../img/pic" .$filename)){
        // echo"圖片修改成功";
     
    }else{
        echo "圖片修改失敗";
    }

}else{
    echo $_FILES['file']['error'][$i];
    $filename=$old_img;
}
}

// $p=$_SERVER['HTTP_REFERER'].$_SERVER["QUERY_STRING"]  ;
// header("location:$p");
// $p=$_SERVER["HTTP_REFERER"].$_SERVER["QUERY_STRING"] ; 
// echo $p;
// header("Refresh:2; url=$p");


?>
