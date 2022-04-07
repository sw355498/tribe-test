<?php
require_once("php/pdo_connect_travel.php");

$id=$_GET["id"];
$sql="SELECT * FROM viewpoint WHERE id ='$id'";
$stmt=$db_host->prepare($sql);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
// echo $p;



//取出area的關聯表資料
$sqlArea="SELECT * FROM area";
$resultArea=$db_host->prepare($sqlArea);
$resultArea->execute();
$area=array(); //空陣列=array
while($rowArea=$resultArea->fetch(PDO::FETCH_ASSOC)){
    $area[$rowArea["id"]]=$rowArea["name"];
}



//取出topic的關聯表資料
$sqlTopic="SELECT * FROM topic";
$resultTopic=$db_host->prepare($sqlTopic);
$resultTopic->execute();
$topic=array(); //空陣列=array
while($rowTopic=$resultTopic->fetch(PDO::FETCH_ASSOC)){
    $topic[$rowTopic["id"]]=$rowTopic["name"];
}


$p=$_SERVER['HTTP_REFERER'];//上一頁
// $URL='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// echo $URL;
// $URL1='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];;
// echo $URL1;
 ?>


<!doctype html>
<html lang="en">
<head>
    <title>景點查詢</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">  
    <style type="text/css">
 
        .side-menu {
            height: 100%;   /* nav隨著body內容撐高先用100vh滿版有需要再做更改 */
        }
        
        .points{
            width: 210px;
            height:160px;
            display:inline-block;
            margin:5px;
        }
        .points img{
            width: 100%;
            height: 100%;
        }
    </style>
    <link rel="stylesheet" href="css/nav_left.css">
</head>
<body>
<div class="d-flex m-0">
    <!--nav-->
    <?php
        require("php/nav_left.php");
      ?>
    <!--nav-->

    

    <!--content start-->
    <div class="flex-fill bd-highlight p-0">
        <div class=" bg-light p-4" style="min-height:100vh ">
            <div class="container">
                <form class="row justify-content-center" action="" method="">                            
                    <?php foreach ($rows as $value) {
                        $stmt_img=$db_host->prepare("SELECT * FROM viewpoint_img WHERE viewpoint_id = ?");
                        $stmt_img->execute([$value["id"]]);
                        $img_rows=$stmt_img->fetchAll(PDO::FETCH_ASSOC);
                    ?>    
                    <input type="hidden" name="id" value="<?=$row["id"]?>">
                    <div class="my-2 col-10">
                        <lable class="form-label font-weight-bold " for="">景點名稱：</lable>
                        <input readonly disabled class="mt-2  form-control  bg-light" type="text" value="<?=$value["name"]?>"></input>
                    </div>
                    <div class="my-3 col-5">
                        <label class="form-label font-weight-bold" for="">景點地區：</label>
                        <input readonly disabled class="form-control  bg-light"  type="text" value="<?=$area[$value["area_id"]]?>">
                    </div>
                    <div class="my-3 col-5">
                        <label class="form-label font-weight-bold" for="">景點主題：</label>
                        <input readonly disabled class="form-control  bg-light"  type="text" value="<?=$topic[$value["topic_id"]]?>">
                    </div>
                    <div class="my-3 col-10">
                        <label class="form-label font-weight-bold" for="">景點介紹：</label>
                        <textarea readonly disabled class="form-control  bg-light" name="" id="" cols="30" rows="6" ><?=$value["intro"]?></textarea>           
                    </div>
                    <div class="my-3 col-10">
                        <label class="form-label font-weight-bold" for="">景點評論：</label>
                        <textarea readonly disabled class="form-control  bg-light" name="" id="" cols="30" rows="4" ><?=$value["review"]?></textarea>
                    </div>
                    <div class="my-3 col-10">
                        <label class="form-label font-weight-bold" for="">景點圖片：</label>
                        <div>
                            <?php foreach($img_rows as $img){?> 
                                <div class="points">
                                    <img src="img/pic/<?=$img["img_src"] ?>" alt="">
                                </div>
                                <?php }?>
                            </div>
                        </div>                        
                        <?php  } ?> 
                    <div class="col-10">
                        <a class="btn btn-success mt-3"  href="<?=$p?>">返回</a>
                    </div> 
                    </div>
                                            
                </form>                 
            </div>
        </div>
    </div>
    
<?php require("script.php") ?>
</body>

</html>

