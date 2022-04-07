<?php

require_once("php/pdo_connect_travel.php");

if(isset($_POST["goodat"])){
    $goodat=$_POST["goodat"];
}else{
    echo "沒有帶資料";
    exit;
}
// echo "link";

if($_FILES["file"]["error"]==0){
    if(move_uploaded_file($_FILES["file"]["tmp_name"], "./upload/". $_FILES["file"]["name"])){
        // echo "Upload success!<br>";
    }else{
        echo "Upload fail!!<br>";
    }

}
$name=$_POST["name"];
$phone=$_POST["phone"];
$email=$_POST["email"];
$gender=$_POST["gender"];
$goodat=$_POST["goodat"];
$certificate=$_POST["certificate"];
$language=$_POST["language"];
$intro=$_POST["intro"];
$bank_account=$_POST["bank_account"];
$now=date('Y-m-d H:i:s');
$file_name=$_FILES["file"]["name"];
$valid="1";

/* 清除陣列空值 */
$language=array_filter($language);

/* 陣列用","分隔轉換成字串 */
$language_str=implode(",",$language);



// $language_arr=array();
// foreach($language as $value){
//     if($value!="" || $value=null){
//         // 把陣列轉換為字串
//         $language = implode('、', $language_arr);
//         array_push($language_arr, $value);
//     }
// }

// $goodat_arr=array();
// foreach($goodat as $value){
//     if($value!="" || $value=null){
//         $goodat = implode('、', $goodat_arr);
//         array_push($goodat_arr, $value);
//     }
// }


// exit();


$sql="INSERT INTO guide (name, phone, email, gender, goodat, certificate, language, intro, bank_account, create_time, picture, valid) 
    VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt=$db_host->prepare($sql);


try{
    $stmt->execute([$name,$phone,$email,$gender, $goodat, $certificate, $language_str/* 需要儲存在同一格,所以需要將陣列拆分組成字串 */, $intro, $bank_account, $now, $file_name, $valid]);
    $last_id=$db_host->lastInsertId();
// echo "新資料已建立"; 
    echo" <script> alert ('新資料建立成功!'); 
    </script>";    


}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}


foreach($language as $value_language){
    $sqlLanguage="INSERT INTO guide_language (guide_id, language_id)VALUES (?,?)";/* pdo連線 VALUES 後面要記的改成(?,?) */
    $stmtLanguage=$db_host->prepare($sqlLanguage);
    try{
        $stmtLanguage->execute([$last_id, intval($value_language)/* 分別儲存在不同格數所以不用特意組成字串,直接使用清除陣列空值得變數foreach分別帶入;因資料表為int所以使用 intval()將變數從str轉換成int */]);
    // echo "新資料已建立";    
    
    
    }catch(PDOException $e){
        echo "資料庫連結失敗<br>";
        echo "Error: ".$e->getMessage(). "<br>";
        exit;
    } 
   
}







// if ($conn->query($sqlLanguage) === TRUE) {
//     echo "新增資料完成";
// } else {
//     echo "新增資料錯誤: " . $conn->error;
// }

// $conn->close();

// header('location: guide-list.php');
header("Refresh:0 ; URL= guide-list.php ");


?>