<?php
require_once("php/pdo_connect_travel.php");

// $id=$_GET["id"];
// $sql="SELECT * FROM guide WHERE id='$id'";
// $result = $conn->query($sql);

$id=$_GET["id"];
$stmt_id=$db_host->prepare("SELECT * FROM guide  WHERE id = ?");
$stmt_id->execute([$id]);
try{    
    $rows_id = $stmt_id->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}

//導遊語言資料表
$stmtGuideLanguage=$db_host->prepare("SELECT * FROM language");
try{
   $stmtGuideLanguage->execute();
    $rowsGuideLanguage=$stmtGuideLanguage->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOExecption $e){
    echo "讀取資料失敗";
}


//語言資料表

$stmtLanguage=$db_host->prepare("SELECT * FROM language");
try{
    $stmtLanguage->execute();
    $rowsLanguage=$stmtLanguage->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOExecption $e){
    echo "讀取資料失敗";
}


$stmtguidelanguage=$db_host->prepare("SELECT * FROM guide_language WHERE guide_id=?");
$stmtguidelanguage->execute([$id]);
$guidelanguageRows=$stmtguidelanguage->fetchAll(PDO::FETCH_ASSOC);

$guide_language=array();
foreach($guidelanguageRows as $value_lan){
    array_push($guide_language, $value_lan["language_id"]);
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>guide</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link href="/travel_css/travel_style.css" rel="stylesheet">
  <link rel="stylesheet" href="css/nav_left.css">
</head>
<style>
.side-menu {
            height: 100%;   /* nav隨著body內容撐高先用100vh滿版有需要再做更改 */
        }
body {
   background-color: #fff;
   font-family: Helvetica;
}
.form-bg{
   background-color: #fff;
   margin: 10px;
   border-radius:5px;
   
}
.fixed-top{
   left:10%;
   top:3%;
}

.intro{
   border:1px #ccc solid;
   width:100%;
}

.upload{
    width: 200px;
    height: 200px; 
    margin: 10px;
}

.upload-img{
    width: 100%;
    height: 100%;
    object-fit: contain;
}
</style>
<body>
<div class="d-flex m-0">
    <!--nav-->
    <?php
        require("php/nav_left.php");
      ?>
    <!--nav-->
<div class="container">
  <div class="row justify-content-md-center">
  <div class="list-group list-group-flush ">
        <a href="guide-list.php" class=" text-secondary text-decoration-none h4 py-2 justify-content-md-center d-flex">
                Guide List   <i class="fas fa-home mx-2"></i>
         </a>
      </div>   
       <div class="col-lg-8 form-bg border-radius: 30px;"> 
    <form action="updateGuide.php" method="post" enctype="multipart/form-data" >
    <hr>
   <?php foreach($rows_id as $value){ ?>
            <input type="hidden" name="id" value="<?=$value["id"]?>">
            <input type="hidden" name="guide_id"?>
            <div class="my-2">
               <label for="id" class="h5">導遊編號</label>
               <input type="text" class="form-control-plaintext text-secondary" name="id" value="<?=$value["id"]?>" readonly>
            </div>
            <div class="mb-2">
               <label for="name" class="h5">姓名</label>
               <input class="form-control-plaintext text-secondary" type="text" id="name" name="name" value="<?=$value["name"]?>" readonly>
            </div>
            <div class="mb-2">
               <label for="phone" class="h5">電話</label>
               <input class="form-control-plaintext text-secondary" type="text" id="phone" name="phone" value="<?=$value["phone"] ?>" readonly>
            </div>
            <div class="mb-2">
               <label for="email" class="h6">E-mail</label>
                  <input class="form-control-plaintext text-secondary" type="text" id="email" name="email" value="<?=$value["email"]?>" readonly>
               </div>
            <div class="mb-2">
                        <label for="gender" class="h5">性別</label>
                        <input class="form-control-plaintext text-secondary" type="text" id="gender" name="gender" value="<?=$value["gender"]?>" readonly>
            </div>
            <div class="mb-2">
                    <label for="goodat" class="h5 me-2">專長</label>
                    <input class="form-control" type="text" id="goodat" name="goodat" value="<?=$value["goodat"]?>"  >
            </div>
            <div class="mb-2">
               <label class="h5">證照</label>
               <input type="text" class="form-control" name="certificate" value="<?=$value["certificate"]?>">
            </div>
            <div class="mb-2">
            <label for="language" class="h5">語言</label>
               <div>
               <?php foreach($rowsLanguage as $value_lan){  ?>
                  <input type="checkbox" name="language[]"
                  <?php if(in_array($value_lan["id"], $guide_language))echo "checked" ?>
                  value="<?=$value_lan["id"]?>"><label for=""><?=$value_lan["name"]?></label>
               <?php } ?>
            </div> 
            <div class="my-2">
               <label class="h5">自我介紹</label>
               <div>
               <textarea id="intro" name="intro" rows="10" cols="80" maxlength="300" class="text-secondary intro";><?=$value["intro"]?></textarea>
               </div>
            </div>
            <div class="mb-2">
               <label class="h5">匯款帳號</label>
               <input type="text" class="form-control" name="bank_account" value="<?=$value["bank_account"]?>">
            </div>
            <div class="mb-2">
               <div class="upload">
               <img class="upload-img rounded" src="upload/<?= $value["picture"]?>" alt="" class=""></td>
               </div>
               <input type="hidden" name="old_picture" value="<?=$value["picture"]?>">
               <img src="images/<?=$value["picture"]?>" alt="">                 
               <label for="">上傳照片</label>
               <input type="file" name="file" >
            </div>
            <button class="btn btn-info" type="submit">更新</button>
            <a href="guide-list.php" class=" btn btn-secondary">
                Guide List
            </a>
    <?php
        } 
     ?>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>