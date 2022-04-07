<?php
require_once("php/pdo_connect_travel.php");

$name=$_POST["name"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$gender=$_POST["gender"];
$id=$_POST["id"];
$gender=$_POST["gender"];
$goodat=$_POST["goodat"];
$certificate=$_POST["certificate"];
$language=$_POST["language"];
$intro=$_POST["intro"];
$bank_account=$_POST["bank_account"];
$old_picture=$_POST["old_picture"];
$guide_id=$_POST["guide_id"];

// 圖片上傳

if($_FILES["file"]["error"]==0){
    $file_name=$_FILES["file"]["name"];
    if(move_uploaded_file($_FILES["file"]["tmp_name"], "./upload/". $_FILES["file"]["name"])){
        // $file_name=$_FILES["file"]["name"];
        // echo "Upload success!<br>";
    }else{
        echo "fail";
    }
    }else{
        $file_name=$old_picture;
        echo "圖片未更新!<br>";
        // echo $_FILES['file']['error'];
    }



$language=array_filter($language);
$languageStr=implode(",", $language);

// $goodat=array_filter($goodat);
// $goodatStr=implode(",", $goodat);


$sql="UPDATE guide SET name=?,phone=?,email=?,gender=?, goodat=?, certificate=?, language=?,intro=?,bank_account=?,picture=? WHERE id=? ";

$stmt=$db_host->prepare($sql);
try{
    $stmt->execute([$name,$phone,$email,$gender, $goodat, $certificate, $languageStr, $intro, $bank_account, $file_name, $id]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $last_id=$db_host->lastInsertId();
    echo" <script> alert ('資料編輯成功!');history.go(-1);</script>";
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}

//參考



$stmt=$db_host->prepare("DELETE FROM guide_language  WHERE guide_id = ?");
$stmt->execute([$id]);
try{    
    
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}

foreach($language as $value_language){
    $sqlLanguage="INSERT INTO guide_language (guide_id, language_id) VALUES (?,?)";
    $stmtLanguage=$db_host->prepare($sqlLanguage);
    try{
        $stmtLanguage->execute([$id, intval($value_language)]);
    // echo "新資料已建立";              
    }catch(PDOException $e){
        echo "資料庫連結失敗<br>";
        echo "Error: ".$e->getMessage(). "<br>";
        exit;
    } 
   
}


// foreach($language as $value_language){
//     $sqlLanguage="UPDATE guide_language SET guide_id=?, language_id=? WHERE id=?";
//     $stmtLanguage=$db_host->prepare($sqlLanguage);
//     try{
//         $stmtLanguage->execute([$guide_id, intval($value_language), $id]);
//     echo "新資料已建立";    
    
    
//     }catch(PDOException $e){
//         echo "資料庫連結失敗<br>";
//         echo "Error: ".$e->getMessage(). "<br>";
//         exit;
//     } 
   
// }




// header('location: guide-list.php');
// header('location: guide.php?id='.$id);
// header("Refresh:0 ; url=$p");



?>