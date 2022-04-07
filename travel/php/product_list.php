<?php

if(!isset($_GET["p"])){
  $p=1;
}else{
  $p=$_GET["p"];
}
$per_page=10;
$start_item=($p-1)*$per_page;


require_once("php/pdo_connect_travel.php");


$sql="SELECT product.*,guide.name AS guide_name FROM product
  JOIN guide ON product.guide_id =guide.id
  LIMIT $start_item, $per_page
  ";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute();
    $row=$stmt->fetchALL(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

$sqlTotal="SELECT product.*,guide.name AS guide_name FROM product
  JOIN guide ON product.guide_id =guide.id
  ";
$stmtTotal=$db_host->prepare($sqlTotal);
try{
    $stmtTotal->execute();
    $amout=$stmtTotal->rowCount();
    $pages= CEIL($amout/$per_page);
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
}

?>
<!doctype html>
<html lang="en">
<head>
    <title>行程列表</title>
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
    </style>
    <link rel="stylesheet" href="css/nav_left.css">
</head>
<body>
<div class="row m-0">
    <!--nav-->
    <?php
        require("php/nav_left.php");
      ?>
    <!--nav-->

    

    <!--content start-->
    <div class="col-lg-9 p-0">
    <div class=" bg-light p-4" style="min-height:100vh">
    
    <form action="product_search.php" method="get" class="d-flex mb-3">
        <input type="text" name="search"  class=" mr-2" required placeholder="請輸入關鍵字">
        <button class="btn btn-info text-nowrap mr-2">搜尋</button>
        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            進階搜尋
        </button>
    </form>
    <div class="collapse mb-3" id="collapseExample">
        <div class="card card-body">     
          <form class="d-flex align-items-center mb-2" action="product_search.php" method="get" accept-charset="utf-8">           
            <select class="form-control mr-2" name="status">
              <option value="1">上架中</option>
              <option value="0">已下架</option>
            </select>
            <button class="btn btn-info text-nowrap" type="submit">查詢</button>
          </form>
          <form class="d-flex align-items-end mb-2" action="product_search.php">
                <label for="s_id" class="text-nowrap mr-2" >商品編碼：</label>
                <input type="text" class="form-control mr-2 " name="s_id" placeholder="請輸入查詢商品序號">
                <button class="btn btn-info text-nowrap" type="submit">查詢</button>
            </form>
          <form class="d-flex align-items-end mb-2" action="product_search.php">
                <label for="date" class="text-nowrap mr-2 ">上架日期：</label>
                <input type="date" class="form-control " name="start">
                <label for="date" class="text-nowrap ">～</label>
                <input type="date" class="form-control mr-2" name="end">
                <button class="btn btn-info text-nowrap" type="submit">查詢</button>
            </form>
            <form class="d-flex align-items-center mb-2" action="product_search.php">           
              <label class="d-flex  text-nowrap mr-2">價格範圍：<span class="input-group-text">$</span></label>
                <input type="text" class="form-control " name="price_start" placeholder="請輸入查詢起始價格">
                <label for="price_end" class="text-nowrap  ">～</label>
                <input type="text" class="form-control  mr-2" name="price_end" placeholder="請輸入查詢最高價格">         
              <button class="btn btn-info text-nowrap" type="submit">查詢</button>
            </form>
        </div>
    </div>
    <table data-toggle="table" data-sortable="true" data-sort-class="table-active" >
        <thead>
            <tr class="text-nowrap text-center">
                <th data-sortable="true">行程編碼</th>
                <th data-sortable="true">行程名稱</th>
                <th data-sortable="true">行程價格</th>
                <th data-sortable="true">架上數量</th>
                <th>行程路線</th>
                <th>行程介紹</th>
                <th data-sortable="true">帶隊導遊</th>
                <th data-sortable="true">商品狀態</th>
                <th data-sortable="true">上架日期</th>
                <th>操作</th>
            </tr>
        </thead>
      <tbody>
                <?php foreach($row as $key => $value) {
                  ?> 
                  <tr class="">
                      <td class="text-right"><?= $value["id"]?></td>
                      <td>
                        <span class="d-inline-block text-truncate" style="max-width: 150px;" title="<?= $value["name"]?>">
                        <?= $value["name"]?>
                        </span>  
                        
                      </td>
                      <td class="text-right">$<?= $value["price"]?></td>
                      <td class="text-right"><?=$value["number"]?></td>
                      <td>
                        <span class="d-inline-block text-truncate" style="max-width: 150px;"title="<?= $value["itinerary"]?>">
                          <?= $value["itinerary"]?>
                        </span>  
                      </td>
                      <td>
                        <span class="d-inline-block text-truncate" style="max-width: 150px;">
                            <?= $value["content"]?>
                        </span>                      
                      </td>
                      <td><?= $value["guide_name"]?></td>
                      <?php 
                      switch($value["status"]){
                        case '0':
                          $status="已下架";
                          break;
                        case '1':
                          $status="上架中";
                          break;
                      }?>                      
                      <td><?= $status?></td>
                      <td><?=  $value["create_time"]?></td>
                      <td class="text-nowrap"><a class="btn btn-info" href="product.php?id=<?=$value["id"]?>">瀏覽</a> <a class="btn btn-danger" href="php/delete_product.php?id=<?=$value["id"]?>">商品下架</a></td>
                  </tr>
                  <?php 
                    }
                  ?>
              </tbody>
              <nav aria-label="Page navigation example mt-2" class="mt-3">
                <ul class="pagination">
                    <?php for($i=1; $i<=$pages ; $i++){ ?>
                    <li class="page-item <?php
                    if($i==$p)echo "active";
                    ?>"><a class="page-link" href="product_list.php?p=<?=$i?>"><?=$i?></a></li>
                    <?php } ?>
                </ul>
              </nav>    
    </table>

    </div>
</div>
    
<?php require("script.php") ?>
</body>

</html>

