<?php
require_once("php/pdo_connect_travel.php");

if(!isset($_GET["p"])){ //因為網站裡本來沒有p這的變數，是後來加的，所以回到商品列表會報錯。給p加上預設值
    $p=1;
}else{
    $p=($_GET["p"]);
}
$per_Page=10; //每頁商品數10
$start_item=($p-1)*10; //起始的商品=頁數-１在乘上10


    $search=$_GET["search"];

    $sql="SELECT viewpoint.*,area.name AS area_name , topic.name AS  topic_name FROM  viewpoint
      JOIN  area  ON area.id = viewpoint.area_id 
      JOIN  topic ON topic.id= viewpoint.topic_id
      WHERE  viewpoint.name LIKE '%$search%' OR viewpoint.id LIKE '%$search%'       
      AND viewpoint.valid=1 LIMIT $start_item, $per_Page ";

     $result=$db_host->prepare($sql);

try{
    $result->execute();
    $rows=$result->fetchAll(PDO::FETCH_ASSOC);

}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

$finalsql="SELECT viewpoint.*,area.name AS area_name , topic.name AS  topic_name FROM  viewpoint
JOIN  area  ON area.id = viewpoint.area_id 
JOIN  topic ON topic.id= viewpoint.topic_id
WHERE  viewpoint.name LIKE '%$search%' OR viewpoint.id LIKE '%$search%'       
AND viewpoint.valid=1 ";

$finalsql=$db_host->prepare($finalsql);
$finalsql->execute();
$result_count=$finalsql->rowCount();    //總筆數
$pages=CEIL($result_count/$per_Page);    //總共有幾頁


//取出area的關聯表資料
$search=$_GET["search"];
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
            width:110px;
            height:90px;
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
    <div class="flex-fill bg-light p-0">
        <div class="bg-light p-4" style="min-height:100vh ">
            <h3 class="my-5">景點列表</h3>
            <div class="row">
                <form action="" method="get" class="d-flex  col-6" >
                    <input type="text" class="form-control" name="search" method="get" placeholder="請輸入關鍵字">
                    <button class="btn btn-info text-nowrap"><i class="fas fa-search"><span class="mx-1">搜尋</span></i></button>
                </form>
            </div>   

            <div class="row d-flex mt-5" >
                <div class="ml-3 mt-3">
                    <a href="viewpoint-list.php" class="btn btn-success">
                        <i class="fas fa-angle-double-left">返回景點列表</i>
                    </a>
                </div>

                <div class="ml-3 mt-4 d-flex">
                    共 
                    <span class="text-info h5 px-1"><?=$result_count?></span>筆 
                    <span class="text-info h5 px-1"><?=$search?></span>
                    的搜尋結果：
                </div>
            </div>
        
            
        
            <table 
            data-toggle="table"  
            class="table table-bordered my-3 align-middle text-center table-striped" 
            style="width:100%"
            >
                <thead class="text-center thead-dark align-middle">
                    <tr>
                        <th data-sortable="true"><div style="width:20px">序號
                        </div></th>
                        <th data-sortable="true">景點</th>
                        <th data-sortable="true">景點地區</th>
                        <th data-sortable="true">景點主題</th>
                        <th class="">景點介紹</th>
                        <th class="">景點照片</th> 
                        <th class="">景點評論</th>
                        <th>功能</th>
                    </tr>                    
                </thead>
                <tbody>
                <?php foreach ($rows as $value) {
                    $stmt_img=$db_host->prepare("SELECT * FROM viewpoint_img WHERE viewpoint_id = ? ");
                    $stmt_img->execute([$value["id"]]);
                    $img_rows=$stmt_img->fetchAll(PDO::FETCH_ASSOC);
                ?>    
                    <tr>
                        <td ><?=$value["id"]?></td>
                        <td><?=$value["name"]?></td>
                        <td><?=$area[$value["area_id"]]?></td>
                        <td><?=$topic[$value["topic_id"]]?></td>
                        <td class="overflow-hidden ">
                            <div class="text-nowrap text-truncate" style="max-height:130px ;max-width: 120px;"><?=$value["intro"]?></div>
                        </td>                        
                        <td>
                            <div class="d-flex">
                                <?php foreach($img_rows as $img){?>
                                    <div class="points">
                                        <img src="img/pic/<?=$img["img_src"] ?>" alt="">
                                    </div>
                                <?php } ?>
                            </div> 
                        </td>
                        <td class="overflow-hidden ">
                            <div class="text-nowrap text-truncate" style="max-height:130px ;max-width: 100px;"><?=$value["review"]?></div>
                        </td>                    
                        <td>   
                            <div class="d-flex flex-column">
                                <a class="mb-1 btn btn-info btn-sm text-nowrap" href="viewpoint-read.php?id=<?=$value["id"]?>"><i class="fas fa-glasses">查看</i></a>
                                <a class="mb-1 btn btn-warning btn-sm text-nowrap" href="viewpoint-update.php?id=<?=$value["id"]?>"><i class="far fa-edit">編輯</i></a>
                                <a class="btn btn-danger btn-sm text-nowrap" href="./php/viewpointDelete.php?id=<?=$value["id"]?>"><i class="fas fa-trash">刪除</i></a>
                            </div>
                        </td>
                    </tr>
                <?php }?>

                </tbody>
            </table>

            <nav aria-label="Page navigation example d-flex my-3">
                <ul class="pagination justify-content-center my-3">
                    <?php for($i=1; $i<=$pages; $i++){ ?>
                        <li class="page-item 
                        <?php if($pages>$i &&  $i==$p)echo "active"; ?>">
                            <a class="page-link "  href="viewpoint-search.php?search=<?=$_GET["search"]?>&p=<?=$i?>"><?=$i?></a>
                        </li>                            
                    <?php } ?>
                </ul>
            </nav>  

        </div>  
     
    </div>
</div>

    
<?php require("script.php") ?>
</body>

</html>