<?php
require_once("php/pdo_connect_travel.php");

if(!isset($_GET["p"])){ //因為網站裡本來沒有p這的變數，是後來加的，所以回到商品列表會報錯。給p加上預設值
    $p=1;
}else{
    $p=($_GET["p"]);
}

$per_Page=10; //每頁商品數10
$start_item=($p-1)*10; //起始的商品=頁數-１在乘上10


//取出總表
$sql="SELECT * FROM viewpoint WHERE valid=1 LIMIT $start_item, $per_Page";
$stmt=$db_host->prepare($sql);

try{
    $stmt->execute();
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOexception $e){
    echo"資料庫連結失敗";
}
// var_dump($rows);



//頁數
$sql="SELECT* FROM viewpoint WHERE valid=1";
$resultTotal=$db_host->prepare($sql);
$resultTotal->execute();
$total=$resultTotal->rowCount(); //總筆數
$pages=CEIL($total/$per_Page); 




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
    <title>景點查看</title>
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
    <div class="flex-fill bd-highlight p-0">
        <div class=" bg-light p-4" style="min-height:100vh ">
            <h3 class="my-5">景點列表</h3>
            <div class="row" >
                <?php foreach ($rows as $values) {
                    $stmt_area=$db_host->prepare("SELECT * FROM area ");
                    $stmt_area->execute();
                    $area_rows=$stmt_area->fetchAll(PDO::FETCH_ASSOC);

                    $stmt_topic=$db_host->prepare("SELECT * FROM topic ");
                    $stmt_topic->execute();
                    $topic_rows=$stmt_topic->fetchAll(PDO::FETCH_ASSOC);
                } ?>

                <!-- 關鍵字搜尋 -->
                    <form action="viewpoint-search.php" method="get" class="d-flex col-6">
                        <input type="text" class="form-control" name="search" placeholder="請輸入關鍵字">
                        <button class="btn btn-info text-nowrap"><i class="fas fa-search"><span class="mx-1">搜尋</span></i></button>                        
                    </form>
            </div>

            <!-- 地區搜尋 -->
            <div class="row  mt-4 d-flex ">
                <form action="areaSearch.php" method="get" class="col-3">
                <div class="d-flex">
                    <select class="custom-select" name="select" id="select" style="color:#666; ">
                        <?php foreach ($area_rows as $areas) {?>
                            <option name="area" value="<?=$areas["id"]?>"><?=$areas["name"]?></option>
                        <?php } ?>    
                    </select>
                    <button class="btn btn-info text-nowrap"><i class="fas fa-search"><span class="mx-1">搜尋</span></i></button>
                </div>
                    <span class="mx-1" style="color:#666; font-style:italic"><small>依地區搜尋</small></span>   
                </form>
                   
                   
                <form action="topicSearch.php" method="get" class="col-3">
                    <div class="d-flex flex-column justify-content-start">
                    <div class="d-flex " >
                        <select class="custom-select" name="select" id="select" style="color:#666;">
                            <!-- <input type="hidden" name="areaSearch"> -->
                            <?php foreach ($topic_rows as $topics) {?>
                                <option name="topic" value="<?=$topics["id"]?>"><?=$topics["name"]?></option>
                            <?php } ?>    
                        </select>
                        <button class="btn btn-info text-nowrap"><i class="fas fa-search"><span class="mx-1">搜尋</span></i></button>   
                    </div>   
                    <div class="" style="color:#666; font-style:italic;"><small>依主題搜尋</small></div> 
                </div>               
                </form>
            </div>

            
            <!-- -->   
            <div class="mt-5">
                <div class="mt-3 position-absolute">
                    <a class=" btn btn-success "  href="viewpoint-create.php"><i class="fas fa-plus-circle">新增景點</i></a>
                <span class="ml-2 mt-5 text-nowrap ">
                    共<span class="text-info h5 px-1"><?=$resultTotal->rowCount()?></span>筆景點資料
                </span>
            </div> 
        
            <!-- table -->
            <div class="table-responsive "> 
            <table 
            data-toggle="table"  
            data-show-toggle="true"
            class="table table-bordered align-middle text-center mt-2 table-striped"
            >
                <thead class="text-center thead-dark align-middle">
                    <tr> 
                        <th data-sortable="true">序號</th>
                        <th data-sortable="true">景點</th>
                        <th data-sortable="true">景點地區</th>
                        <th data-sortable="true">景點主題</th>
                        <th>景點介紹</th>
                        <th>景點照片</th> 
                        <th>景點評論</th>
                        <th>功能</th>
                    </tr>
                </thead>
                
            
                <tbody>
                    <?php foreach ($rows as $value) {
                        $stmt_img=$db_host->prepare("SELECT * FROM viewpoint_img WHERE viewpoint_id = ?");
                        $stmt_img->execute([$value["id"]]);
                        $img_rows=$stmt_img->fetchAll(PDO::FETCH_ASSOC);
                    ?>   

                    <tr> 
                        <td><?=$value["id"]?></td>
                        <td class="text-nowrap"><?=$value["name"]?></td>
                        <td><?=$area[$value["area_id"]]?></td>
                        <td><?=$topic[$value["topic_id"]]?></td>
                        <td class="overflow-hidden ">
                            <div class="text-nowrap text-truncate" style="max-height:130px ;max-width: 120px;"><?=$value["intro"]?></div>
                        </td>
                        <td >
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
                        <td >
                            <div class="d-flex flex-column">
                                <a class="mb-1 btn btn-info btn-sm text-nowrap" href="viewpoint-read.php?id=<?=$value["id"]?>"><i class="fas fa-glasses">查看</i></a>
                                <a class="mb-1 btn btn-warning btn-sm text-nowrap" href="viewpoint-update.php?id=<?=$value["id"]?>"><i class="far fa-edit">編輯</i></a>
                                <a class="btn btn-danger btn-sm text-nowrap" href="php/viewpointDelete.php?id=<?=$value["id"]?>"><i class="fas fa-trash">刪除</i></a>
                            </div>
                            </td>
                    </tr>
                    <?php }   ?>
                    
                </tbody>                
            </table>
          </div>
            <!-- 頁碼 -->
            <nav aria-label="Page navigation example d-flex">
                <ul class="pagination justify-content-center mt-4">
                <?php for($i=1; $i<=$pages; $i++){ ?>
                    <li class="page-item 
                        <?php if($i==$p)echo "active"; ?>">
                        <a class="page-link "  href="viewpoint-list.php?p=<?=$i?>"><?=$i?></a>
                    </li>                           
                <?php } ?>
                </ul>
            </nav>  
        </div>                    
    </div>         
      
    </div>
</div>
    
<?php require("script.php") ?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

    <script>
        // $(document).ready(function() {

        //     $('#example').DataTable({
        //         "language": {
        //             "processing": "處理中...",
        //             "loadingRecords": "載入中...",
        //             "lengthMenu": "顯示 _MENU_ 項結果",
        //             "zeroRecords": "沒有符合的結果",
        //             "info": "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
        //             "infoEmpty": "顯示第 0 至 0 項結果，共 0 項",
        //             "infoFiltered": "(從 _MAX_ 項結果中過濾)",
        //             "infoPostFix": "",
        //             "search": "搜尋:",
        //             "paginate": {
        //                 "first": "第一頁",
        //                 "previous": "上一頁",
        //                 "next": "下一頁",
        //                 "last": "最後一頁"
        //             },
        //             "aria": {
        //                 "sortAscending": ": 升冪排列",
        //                 "sortDescending": ": 降冪排列"
        //             }
        //         },
        //         pagingType: 'full_numbers',
        //         order:[[0,'desc'],],
        //     });
        // });
    </script>
</body>

</html>

