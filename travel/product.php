<?php
require_once("php/pdo_connect_travel.php");
$id=$_GET["id"];
$sql="SELECT * FROM product WHERE id='$id'";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute();
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "讀取資料失敗";
}


?>
<!doctype html>
<html lang="en">
<head>
    <title>修改行程</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
        <div class="container">
            <form action="php/update_product.php" method="post">
                <?php if ($stmt->execute() > 0):
                    while($rows=$stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <input type="hidden" name="id" value="<?= $rows["id"]?>"> 
                <div class="mb-2">
                    <label>行程名稱：</label>
                    <input type="text" class="form-control" name="name" value="<?= $rows["name"]?>">
                </div>
                <div class="mb-2">
                    <label>行程價格：</label>
                    <input type="text" class="form-control" name="price" value="<?= $rows["price"]?>">
                </div>
                <div class="mb-2">
                    <label>架上數量：</label>
                    <input type="text" class="form-control" name="number" value="<?= $rows["number"]?>">
                </div>
                <div class="mb-2 row">
                    <div class="col">
                    <label>地點標籤：</label>
                        <?php
                        /* 用explode將viewpoint_id欄位字串拆分為陣列 */
                        $viewpoint_arr=explode(",",$rows["viewpoint_id"]);
                        foreach($viewpoint_arr as $viewpoint_int){
                            $stmt_viewpoint=$db_host->prepare("SELECT * FROM viewpoint WHERE id=?");
                            $stmt_viewpoint->execute([$viewpoint_int]);
                            $rows_viewpoint = $stmt_viewpoint->fetchAll(PDO::FETCH_ASSOC);
                            /* 第三層迴圈：撈出各別viewpoint的name */
                            foreach($rows_viewpoint as $c){
                        ?>
                                <select  class="form-control" name="viewpoint_id[]">
                                        <option value="<?= $c["id"]?>"><?=$c["name"]?></option>
                                        <option value="">取消此地點標籤</option>
                                        <?php
                                            $stmt_viewpoint_all=$db_host->prepare("SELECT * FROM viewpoint");
                                            $stmt_viewpoint_all->execute();
                                            $rows_viewpoint_all = $stmt_viewpoint_all->fetchAll(PDO::FETCH_ASSOC);
                                            foreach($rows_viewpoint_all AS $viewpoint_all){
                                        ?>
                                            <option value="<?= $viewpoint_all['id']?>"><?= $viewpoint_all["name"]?></option>
                                        <?php }?>
                                </select>
                                <!-- <input type="hidden" class="form-control" name="viewpoint_id" value="<?= $c["id"]?>"><div>#<?=$c["name"]?></div> -->
                            <?php }?>
                        <?php }?>
                    </div>
                </div>
                <div class="mb-2">
                        <label for="itinerary">主題行程</label>
                        <select  class="form-control" name="topic_id">
                            <?php if($rows["topic_id"]==null){ ?> 
                                    <option value="">請選擇主題</option>
                                    <?php 
                                    $stmt_topic_all=$db_host->prepare("SELECT * FROM topic");
                                    $stmt_topic_all->execute();
                                    $rows_topic_all = $stmt_topic_all->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($rows_topic_all AS $topic_all){ ?>            
                                        <option value="<?= $topic_all['id']?>"><?= $topic_all["name"]?></option>
                                    <?php }?>
                            <?php }else{
                                    $a=$rows["topic_id"];                        
                                    $stmt_topic=$db_host->prepare("SELECT id,name FROM topic WHERE id=$a");
                                    $stmt_topic->execute();
                                    $rows_topic=$stmt_topic->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($rows_topic AS $topic_name){
                                ?>
                                    <option value="<?= $rows["topic_id"]?>"><?= $topic_name["name"]?></option>
                                    <?php }?>

                                    <option value="">刪除主題</option>
                                    <?php 
                                    $stmt_topic_all=$db_host->prepare("SELECT * FROM topic");
                                    $stmt_topic_all->execute();
                                    $rows_topic_all = $stmt_topic_all->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($rows_topic_all AS $topic_all){ ?>            
                                        <option value="<?= $topic_all['id']?>"><?= $topic_all["name"]?></option>
                                    <?php }?>
                            <?php }?>                   

                        </select>
                    </div>
                <div class="mb-2">
                    <label>行程路線：</label>
                    <input type="text" class="form-control" name="itinerary" value="<?= $rows["itinerary"]?>">
                </div>
                <div class="mb-2">
                    <label>帶隊導遊：</label>
                    <?php
                        $b=$rows["guide_id"];                        
                        $stmt_guide=$db_host->prepare("SELECT id,name FROM guide WHERE id=$b");
                        $stmt_guide->execute();
                        $rows_guide=$stmt_guide->fetchAll(PDO::FETCH_ASSOC);
                        foreach($rows_guide AS $guide_name){
                    ?>
                   
                        <input type="hidden" class="form-control" name="guide_id" value="<?= $guide_name["id"]?>" readonly><?= $guide_name["name"]?>
                    <?php }?>
                </div>
                <div class="mb-2">
                    <!-- 使用id套用   WYSIWYG編輯器(CKEditor套件) -->   
                    <label>行程介紹：</label>
                    <textarea name="content" class="form-control"  id="floatingTextarea2"><?= $rows["content"]?></textarea>
                </div>
                <?php 
                    switch($rows["status"]){
                        case '0':
                            $status="已下架";
                        break;
                        case '1':
                            $status="上架中";
                        break;
                  }?>        
                <div class="mb-2">
                    <label>商品狀態：</label>
                    <input type="hidden" class="form-control" name="status" value="<?=$rows["status"]?>"><?= $status?>
                </div>
                <div class="mb-2">
                    <label>上架時間：</label>
                    <span><?= $rows["create_time"]?></span>
                </div>               
                <button class="btn btn-info" type="submit">更新行程</button>
                <a class="btn  btn-success" href="product_list.php"><i class="fas fa-angle-double-left">返回行程列表</i></a>
                <?php 
                } 
                endif?>
            </form>
            </div>
        </div>
    </div>
</div>
    
<?php require("script.php") ?>
</body>

</html>