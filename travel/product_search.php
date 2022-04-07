<?php
require_once("php/pdo_connect_travel.php");

if(!isset($_GET["p"])){
  $p=1;
}else{
  $p=$_GET["p"];
}
$per_page=10;
$start_item=($p-1)*$per_page;


/* 關鍵字篩選 */
if(isset($_GET["search"])){
  $search=$_GET["search"];
  $find=$_GET["search"];
  $sql="SELECT product.*,guide.name AS guide_name FROM product
  JOIN guide ON product.guide_id =guide.id WHERE (product.id LIKE '%$search%'
  OR product.name LIKE '%$search%'
  OR product.itinerary LIKE '%$search%'
  OR product.content LIKE '%$search%'
  OR guide.name LIKE '%$search%')
  AND ( status=1 OR status=0)
  LIMIT $start_item , $per_page
  ";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute();
    $row=$stmt->fetchALL(PDO::FETCH_ASSOC);
    $amount=$stmt->rowCount();/* 當頁筆數 */
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
  }
/* 計算頁數 */
$sqlTotal="SELECT product.*,guide.name AS guide_name FROM product
JOIN guide ON product.guide_id =guide.id WHERE (product.id LIKE '%$search%'
OR product.name LIKE '%$search%'
OR product.itinerary LIKE '%$search%'
OR product.content LIKE '%$search%'
OR guide.name LIKE '%$search%')
AND ( status=1 OR status=0)
";

$stmtTotal=$db_host->prepare($sqlTotal);
$stmtTotal->execute();
$total=$stmtTotal->rowCount(); //總共筆數
$pages=ceil($total/$per_page); //總頁數
}

/* 商品狀態篩選 */
else if(isset($_GET["status"])){
  $status=$_GET["status"];
    /* 搜尋結果顯示字樣 */
    switch($status){
      case '0':
        $find="已下架";
        break;
      case '1':
        $find="上架中";
        break;
    }
  $sql="SELECT product.*,guide.name AS guide_name FROM product
  JOIN guide ON product.guide_id =guide.id 
  WHERE product.status = $status
  LIMIT $start_item , $per_page
  ";
$stmt=$db_host->prepare($sql);
try{
  $stmt->execute();
  $row=$stmt->fetchALL(PDO::FETCH_ASSOC);
  $amount=$stmt->rowCount();/* 當頁筆數 */
}catch(PDOException $e){
  echo "資料庫連結失敗<br>";
  echo "Eroor: ".$e->getMessage(). "<br>";
  exit;
}
/* 計算頁數 */
$sqlTotal="SELECT product.*,guide.name AS guide_name FROM product
JOIN guide ON product.guide_id =guide.id 
WHERE product.status = $status
";

$stmtTotal=$db_host->prepare($sqlTotal);
$stmtTotal->execute();
$total=$stmtTotal->rowCount(); //總共筆數
$pages=ceil($total/$per_page); //總頁數
}

/* 編碼篩選 */
else if(isset($_GET["s_id"])){
  $find="第".$_GET["s_id"]."筆";
  $s_id=$_GET["s_id"];
  $sql="SELECT product.*,guide.name AS guide_name FROM product
  JOIN guide ON product.guide_id =guide.id 
  WHERE product.id = $s_id
  LIMIT $start_item , $per_page
  ";
$stmt=$db_host->prepare($sql);
try{
  $stmt->execute();
  $row=$stmt->fetchALL(PDO::FETCH_ASSOC);
  $amount=$stmt->rowCount();/* 當頁筆數 */
}catch(PDOException $e){
  echo "資料庫連結失敗<br>";
  echo "Eroor: ".$e->getMessage(). "<br>";
  exit;
}
/* 計算頁數 */
$sqlTotal="SELECT product.*,guide.name AS guide_name FROM product
JOIN guide ON product.guide_id =guide.id 
WHERE product.id = $s_id
";
$stmtTotal=$db_host->prepare($sqlTotal);
$stmtTotal->execute();
$total=$stmtTotal->rowCount(); //總共筆數
$pages=ceil($total/$per_page); //總頁數
}


/* 日期篩選 */
else if(isset($_GET["start"]) && isset($_GET["end"])){
    $find=$_GET["start"]."~".$_GET["end"];
    $start=$_GET["start"];
    $end=$_GET["end"];
    $sql="SELECT product.*,guide.name AS guide_name FROM product
    JOIN guide ON product.guide_id =guide.id 
    WHERE (product.create_time BETWEEN '$start' AND '$end')
    AND ( status=1 OR status=0)
    LIMIT $start_item , $per_page
    -- ORDER BY  product.id DESC
    ";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute();
    $row=$stmt->fetchALL(PDO::FETCH_ASSOC);
    $amount=$stmt->rowCount();/* 當頁筆數 */
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
  }
  /* 計算頁數 */
  $sqlTotal="SELECT product.*,guide.name AS guide_name FROM product
  JOIN guide ON product.guide_id =guide.id 
  WHERE (product.create_time BETWEEN '$start' AND '$end')
  AND ( status=1 OR status=0)
  ";
  $stmtTotal=$db_host->prepare($sqlTotal);
  $stmtTotal->execute();
  $total=$stmtTotal->rowCount(); //總共筆數
  $pages=ceil($total/$per_page); //總頁數
}

/* 價格篩選 */
else if(isset($_GET["price_start"]) && isset($_GET["price_end"])){
  $find="$".$_GET["price_start"]." ~ ".$_GET["price_end"];
  $price_start=$_GET["price_start"];
  $price_end=$_GET["price_end"];

  /* 設定價格篩選最大最小初始值 */
    if(empty($price_start)){
      $price_start=0;
    }
    if(empty($price_end)){
      $price_end=999999;
    }

  $sql="SELECT product.*,guide.name AS guide_name FROM product
  JOIN guide ON product.guide_id =guide.id 
  WHERE (product.price>$price_start AND product.price < $price_end)
  AND ( status=1 OR status=0)
  LIMIT $start_item , $per_page
  ";
  $stmt=$db_host->prepare($sql);
  try{
    $stmt->execute();
    $row=$stmt->fetchALL(PDO::FETCH_ASSOC);
    $amount=$stmt->rowCount();/* 當頁筆數 */
  }catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Eroor: ".$e->getMessage(). "<br>";
    exit;
  }
    /* 計算頁數 */
    $sqlTotal="SELECT product.*,guide.name AS guide_name FROM product
    JOIN guide ON product.guide_id =guide.id 
    WHERE (product.price>$price_start AND product.price < $price_end)
    AND ( status=1 OR status=0)
    ";
    $stmtTotal=$db_host->prepare($sqlTotal);
    $stmtTotal->execute();
    $total=$stmtTotal->rowCount(); //總共筆數
    $pages=ceil($total/$per_page);  //總頁數
}

/* 顯示全部 */
else{
  $find="尚未搜尋";
  $sql="SELECT product.*,guide.name AS guide_name FROM product
  JOIN guide ON product.guide_id =guide.id
  WHERE  status=1 
  OR status=0
  LIMIT $start_item , $per_page
  ";
  $stmt=$db_host->prepare($sql);
  try{
      $stmt->execute();
      $row=$stmt->fetchALL(PDO::FETCH_ASSOC);
      $amount=$stmt->rowCount();/* 當頁筆數 */
  }catch(PDOException $e){
      echo "資料庫連結失敗<br>";
      echo "Eroor: ".$e->getMessage(). "<br>";
      exit;
  }
  /* 計算頁數 */
  $sqlTotal="SELECT product.*,guide.name AS guide_name FROM product
  JOIN guide ON product.guide_id =guide.id
  WHERE  status=1 
  OR status=0
  ";
  $stmtTotal=$db_host->prepare($sqlTotal);
  $stmtTotal->execute();
  $total=$stmtTotal->rowCount(); //總共筆數
  $pages=ceil($total/$per_page); //總頁數
}





?>

<!doctype html>
<html lang="en">
<head>
    <title>查詢行程</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">  
    <style type="text/css">
 
        .side-menu {
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
        <h3 class="my-5">行程列表</h3>
    <form method="get" class="d-flex mb-3">
        <input type="text" name="search"  class=" mr-2" required placeholder="請輸入關鍵字">
        <button class="btn btn-info text-nowrap mr-2">搜尋</button>
        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            進階搜尋
        </button>
    </form>
    
    <div class="collapse mb-3" id="collapseExample">
        <div class="card card-body">     
          <form class="d-flex align-items-center mb-2" method="get" accept-charset="utf-8">           
            <select class="form-control mr-2" name="status">
              <option value="1">上架中</option>
              <option value="0">已下架</option>
            </select>
            <button class="btn btn-info text-nowrap" type="submit">查詢</button>
          </form>
          <form class="d-flex align-items-end mb-2" >
                <label for="s_id" class="text-nowrap mr-2">商品編碼：</label>
                <input type="text" class="form-control mr-2 " name="s_id" placeholder="請輸入查詢商品序號">
                <button class="btn btn-info text-nowrap" type="submit">查詢</button>
            </form>
          <form class="d-flex align-items-end mb-2" >
                <label for="date" class="text-nowrap mr-2 ">上架日期：</label>
                <input type="date" class="form-control " name="start">
                <label for="date" class="text-nowrap ">～</label>
                <input type="date" class="form-control mr-2" name="end">
                <button class="btn btn-info text-nowrap" type="submit">查詢</button>
            </form>
            <form class="d-flex align-items-center mb-2" >           
              <label class="d-flex  text-nowrap mr-2">價格範圍：<span class="input-group-text">$</span></label>
                <input type="text" class="form-control " name="price_start"  placeholder="請輸入查詢起始價格">
                <label for="price_end" class="text-nowrap  ">～</label>
                <input type="text" class="form-control  mr-2" name="price_end"  placeholder="請輸入查詢最高價格">         
              <button class="btn btn-info text-nowrap" type="submit">查詢</button>
            </form>
        </div>
    </div>
    <!-- -->   
      <div class="mt-5 mb-3">
        <a href="product_list.php" class="btn btn-success">
          <i class="fas fa-angle-double-left">返回行程列表</i>
        </a>
    <!-- -->  
      <span class="p-2 text-nowrap ">
          "
          <span class="text-info "> 
            <?=$find?> 
          </span>
          "的搜尋結果,共有
          <span class="text-info "> 
            <?=$total?> 
          </span>
        筆行程,本頁顯示
          <span class="text-info "> 
            <?=$amount?>
          </span> 
        筆資料
      </span>
    </div> 
    <form id="form1" method="post">
      <table data-toggle="table" data-sortable="true" data-sort-class="table-active"  class="table table-striped">
          <thead class="text-center thead-dark align-middle">
              <tr class="text-nowrap text-center">
                  <!-- <th><input type="checkbox" id="select-all">全選</th> -->
                  <th data-sortable="true">行程編碼</th>
                  <th data-sortable="true">行程名稱</th>
                  <th data-sortable="true">行程價格</th>
                  <th data-sortable="true">架上數量</th>
                  <th data-sortable="true">行程路線</th>
                  <th data-sortable="true">行程介紹</th>
                  <th data-sortable="true">帶隊導遊</th>
                  <th data-sortable="true">商品狀態</th>
                  <th data-sortable="true">上架日期</th>
                  <th data-sortable="true">操作</th>
              </tr>
          </thead>
        <tbody>
                  <?php foreach($row as $key => $value) {
                    ?> 
                    <tr class="text-center">
                        <!-- <td><input type="checkbox" name="check[]" value=""></td> -->
                        <td class=""><?= $value["id"]?></td>
                        <td>
                          <span class="d-inline-block text-truncate" style="max-width: 100px;" title="<?= $value["name"]?>">
                          <?= $value["name"]?>
                          </span>                          
                        </td>
                        <td class="">$<?= $value["price"]?></td>
                        <td class=""><?=$value["number"]?></td>
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
                        <td class="text-nowrap"><?=  $value["create_time"]?></td>
                        <td class="text-nowrap"><a class="btn btn-info" href="product.php?id=<?=$value["id"]?>"><i class="far fa-edit">瀏覽</i></a>
                          <?php 
                            switch($value["status"]){
                              case '0':
                          ?>
                                <a class="btn btn-warning" href="php/product_put_on.php?id=<?=$value["id"]?>"><i class="fas fa-file-import">商品上架</i></a>
                            <?php
                              break;
                              case '1':
                            ?>
                                <a class="btn btn-warning" href="php/product_put_down.php?id=<?=$value["id"]?>"><i class="fas fa-file-export">商品下架</i></a>
                            <?php
                              break;
                          }?> 
                            <a class="btn btn-danger" href="php/product_delete.php?id=<?=$value["id"]?>"><i class="fas fa-trash">商品刪除</i></a>
                        </td> 
                        </tr>
                    <?php 
                      }
                    ?>
                </tbody>
      </table>
    </form>
            <!-- 頁碼 -->
            <nav aria-label="Page navigation example d-flex">
                <ul class="pagination justify-content-center mt-4">
                    <!-- 關鍵字篩選分頁 -->
                    <?php  if(isset($_GET["search"])){?>
                      <?php for($i=1; $i<=$pages ; $i++){ ?>
                        <li class="page-item <?php if($i==$p)echo "active";?>">
                        <a class="page-link" 
                        href="product_search.php?
                          search=<?=$_GET["search"]?>&
                          p=<?=$i?>
                          "><?=$i?></a></li>
                      <?php } ?>
                    <!-- 商品狀態篩選分頁 -->
                    <?php }else if(isset($_GET["status"])){ ?>
                        <?php for($i=1; $i<=$pages ; $i++){ ?>
                      <li class="page-item <?php if($i==$p)echo "active";?>">
                      <a class="page-link" 
                      href="product_search.php?
                        status=<?=$_GET["status"]?>&
                        p=<?=$i?>
                        "><?=$i?></a></li>
                      <?php } ?>
                    <!-- 編碼篩選分頁 -->
                    <?php }else if(isset($_GET["s_id"])){ ?>
                    <?php for($i=1; $i<=$pages ; $i++){ ?>
                      <li class="page-item <?php if($i==$p)echo "active";?>">
                      <a class="page-link" 
                      href="product_search.php?
                        s_id=<?=$_GET["s_id"]?>&
                        p=<?=$i?>
                        "><?=$i?></a></li>
                      <?php } ?>
                    <!-- 日期篩選分頁 -->
                    <?php } else if(isset($_GET["start"]) && isset($_GET["end"])){?>                    
                    <?php for($i=1; $i<=$pages ; $i++){ ?>
                      <li class="page-item <?php if($i==$p)echo "active";?>">
                      <a class="page-link" 
                      href="product_search.php?
                        start=<?=$_GET["start"]?>&
                        end=<?=$_GET["end"]?>&
                        p=<?=$i?>
                        "><?=$i?></a></li>
                      <?php } ?>
                    <!-- 價格篩選 -->
                    <?php } else if(isset($_GET["price_start"]) && isset($_GET["price_end"])){?>
                      <?php for($i=1; $i<=$pages ; $i++){ ?>
                      <li class="page-item <?php if($i==$p)echo "active";?>">
                      <a class="page-link" 
                      href="product_search.php?
                        price_start=<?=$_GET["price_start"]?>&
                        price_end=<?=$_GET["price_end"]?>&
                        p=<?=$i?>
                        "><?=$i?></a></li>
                      <?php } ?>
                    <?php }else{ ?>
                    <?php for($i=1; $i<=$pages ; $i++){ ?>
                      <li class="page-item <?php if($i==$p)echo "active";?>">
                      <a class="page-link" 
                      href="product_search.php?
                        p=<?=$i?>
                        "><?=$i?></a></li>
                      <?php } ?>
                    <?php } ?>                   
                </ul>
        </nav>    
    </div>
</div>
<?php require("script.php") ?>
<!-- <script>
        $(document).ready(function(){
            $("#form1 #select-all").click(function(){
                $("#form1 input[type='checkbox']").prop('checked',this.checked);
            });
        });
</script> -->
</body>
</html>