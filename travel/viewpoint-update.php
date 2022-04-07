<?php
require_once("php/pdo_connect_travel.php");

$id=$_GET["id"];
$sql="SELECT * FROM viewpoint WHERE id ='$id'";
$stmt=$db_host->prepare($sql);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
$p=$_SERVER['HTTP_REFERER'];//上一頁


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



?>
<!doctype html>
<html lang="en">
<head>
    <title>修改景點</title>
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
            height:170px;
            display:inline-block;
            margin:5px;
        }
        .points img{
            width: 100%;
            height: 100%;
        } 
        label{
            color:#333;
            font-size:17px;

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
        <form class="row justify-content-center" action="php/viewpointUpdate.php" method="post" enctype="multipart/form-data">
        <?php foreach ($rows as $value) {
              $stmt_img=$db_host->prepare("SELECT * FROM viewpoint_img WHERE viewpoint_id = ?");
              $stmt_img->execute([$value["id"]]);
              $img_rows=$stmt_img->fetchAll(PDO::FETCH_ASSOC);
            
              $stmt_area=$db_host->prepare("SELECT * FROM area ");
              $stmt_area->execute();
              $area_rows=$stmt_area->fetchAll(PDO::FETCH_ASSOC);

              $stmt_topic=$db_host->prepare("SELECT * FROM topic ");
              $stmt_topic->execute();
              $topic_rows=$stmt_topic->fetchAll(PDO::FETCH_ASSOC);

        ?>  

                <input type="hidden" name="id" value="<?=$value["id"]?>">

                <div class="col-10 my-2">
                    <label class="font-weight-bold form-label" for="">景點名稱：</label>
                    <input class=" form-control" type="text" value="<?=$value["name"]?>" name="name"></input>
                </div>

            <!-- 景點地區 -->
                <div class="mt-4 col-5">
                    <label class="form-label font-weight-bold" for="">景點地區：</label>
                        <div>
                            <select class="custom-select mb-1" name="area" >
                            <?php foreach ($area_rows as $area) { ?>  
                            <option value="<?=$area["id"]?>" name=""><?=$area["name"]?></option>
                            <?php }?>
                            </select>
                        </div>
                </div>

        <!-- 景點主題 -->      
                <div class="mt-4 col-5">
                    <label class="form-label font-weight-bold" for="">景點主題：</label>
                        <div>
                            <select class="custom-select mb-1" name="topic">
                            <?php foreach ($topic_rows as $topic) { ?>  
                            <option  value="<?=$topic["id"]?>" name=""><?=$topic["name"]?></option>
                            <?php } ?> 
                            </select>
                        </div>
                </div>

         <!-- 景點介紹 -->
                <div class="mt-5 col-10">
                    <label class="form-label font-weight-bold" for="">景點介紹：</label>
                    <textarea  class="form-control " name="intro" id="" cols="30" rows="6" ><?=$value["intro"]?></textarea>
                </div>
                
        <!-- 景點評論 -->       
                <div class="mt-5 col-10">
                    <label class="form-label font-weight-bold" for="">景點評論：</label>
                    <textarea  class="form-control" name="review" id="" cols="30" rows="4" ><?=$value["review"]?></textarea>
                </div>

            <!--圖片 -->
            <div class="mt-5 col-10 ">
                    <label class="formFileMultiple font-weight-bold" for="">景點圖片：</label>
                    <div class=" points d-flex"> 
                        <?php foreach($img_rows as $img){?>  
                        <input type="hidden" name="old_img" value="<?=$img["img_src"] ?>">
                            <img  class="mx-1" src="img/pic/<?=$img["img_src"] ?>" alt="">
                            <?php } ?> 
                    </div>  
                    <div>
                        <input type="file" name="file[]" multiple id="formFileMultiple"  accept="image/gif,image/png,image/jpg,image/jpeg"> 
                        <input type="hidden" class="imageurl" > 
                    </div>      
                        
                    
            </div>
            <!-- -->
                <div class="d-flex mt-5 col-10 justify-content-between">
                    <a class="btn btn-success" href="<?php echo $_SERVER['HTTP_REFERER']?>"> 返回</a>
                    <div>
                        <button type="submit" class="btn btn-info mx-3" name="update" >更新</button>
                        <button type="reset" class="btn btn-secondary" >重置</button>
                    </div>
                </div>
            <?php } ?>            
            </form>
        </div>
    </div>
  </div>
</div>

<!-- <?php echo $_SERVER['HTTP_REFERER'].$_SERVER["QUERY_STRING"]?> -->
<?php require("script.php") ?>
</body>

</html>

