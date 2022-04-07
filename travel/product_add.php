<?php
require_once("php/pdo_connect_travel.php");

/* 撈取資料庫景點做下拉式選單 */
$sql="SELECT id,name FROM viewpoint";
$stmt_viewpoint=$db_host->prepare($sql);
try{
    $stmt_viewpoint->execute();
    $rows_viewpoint=$stmt_viewpoint->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "讀取資料失敗";
}

/* 撈取資料庫導遊做下拉式選單 */
$sql="SELECT id,name FROM guide";
$stmt_guide=$db_host->prepare($sql);
try{
    $stmt_guide->execute();
    $rows_guide=$stmt_guide->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "讀取資料失敗";
}

/* 撈取資料庫主題做下拉式選單 */
$sql="SELECT id,name FROM topic";
$stmt_topic=$db_host->prepare($sql);
try{
    $stmt_topic->execute();
    $rows_topic=$stmt_topic->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "讀取資料失敗";
}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>新增行程</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">  
    <style type="text/css">
        body,html{
            overflow-x: hidden;
            height: 100%;
            
        }
        .side-menu {
            height: 100%;
        }
        .start_color{
            color:red;
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
    <!--nav end-->

    <!--content start-->
    <div class="flex-fill bd-highlight p-0">
        <div class=" bg-light p-4" style="min-height:100vh ">
                <form action="php/insert_product.php" method="post" class="mx-5">
                    <div class="mb-2">
                        <label for="name">行程名稱<small class="start_color">*必填</small></label>
                        <input type="text" class="form-control" name="name" required placeholder="請輸入行程名稱" autofocus>
                    </div>
                    <div class="mb-2">
                        <label for="price">行程價格<small class="start_color">*必填</small></label>
                        <input type="text" class="form-control" name="price" required placeholder="請輸入行程價格">
                    </div>
                    <div class="mb-2">
                        <label for="number">行程上架數量<small class="start_color">*必填</small></label>
                        <input type="text" class="form-control" name="number" required placeholder="請輸入行程上架數量">
                    </div>
                    <div class="mb-2">
                        <label for="attractions_id">地點標籤</label>
                        <div class="row">
                            <div class="col">
                                <select  class="form-control" name="viewpoint_id[]">
                                    <option value="">請選擇景點標籤</option>
                                    <?php
                                        foreach($rows_viewpoint AS $viewpoint){
                                    ?>
                                        <option value="<?= $viewpoint['id']?>"><?= $viewpoint["name"]?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col">
                                <select  class="form-control" name="viewpoint_id[]">
                                    <option value="">請選擇景點標籤</option>
                                    <?php
                                        foreach($rows_viewpoint AS $viewpoint){
                                    ?>
                                        <option value="<?= $viewpoint['id']?>"><?= $viewpoint["name"]?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col">
                                <select  class="form-control" name="viewpoint_id[]">
                                    <option value="">請選擇景點標籤</option>
                                    <?php
                                        foreach($rows_viewpoint AS $viewpoint){
                                    ?>
                                        <option value="<?= $viewpoint['id']?>"><?= $viewpoint["name"]?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col">
                                <select  class="form-control" name="viewpoint_id[]">
                                    <option value="">請選擇景點標籤</option>
                                    <?php
                                        foreach($rows_viewpoint AS $viewpoint){
                                    ?>
                                        <option value="<?= $viewpoint['id']?>"><?= $viewpoint["name"]?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col">
                                <select  class="form-control" name="viewpoint_id[]">
                                    <option value="">請選擇景點標籤</option>
                                    <?php
                                        foreach($rows_viewpoint AS $viewpoint){
                                    ?>
                                        <option value="<?= $viewpoint['id']?>"><?= $viewpoint["name"]?></option>
                                    <?php }?>
                                </select>
                            </div>                       
                        </div>               
                    </div>
                    <div class="mb-2">
                        <label for="itinerary">主題行程</label>
                        <select  class="form-control" name="topic">
                            <option value="">請選擇主題</option>
                                <?php
                                    foreach($rows_topic AS $topic){
                                ?>
                                <option value="<?= $topic['id']?>"><?= $topic["name"]?></option>
                                <?php }?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="itinerary">行程路線<small class="start_color">*必填</small></spand></label>
                        <input type="text" class="form-control" name="itinerary" required  placeholder="請輸入行程路線 ex:太魯閣牌樓 → 太魯閣國家公園遊客中心→砂卡礑步道→小錐麓步道→燕子口→白楊步道 景觀台 ">
                    </div>
                    <div class="mb-2">
                        <label for="guide_id">帶隊導遊<small class="start_color">*必填</small></spand></label>
                        <select  class="form-control" name="guide_id" required>
                            <option value=""  >請選擇帶隊導遊</option>
                                <?php
                                    foreach($rows_guide AS $guide){
                                ?>
                                <option value="<?= $guide['id']?>"><?= $guide["name"]?></option>
                                <?php }?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <!-- 使用id套用   WYSIWYG編輯器(CKEditor套件) -->   
                        <label for="floatingTextarea2">行程介紹</label>                
                        <textarea name="content" class="form-control"  id="floatingTextarea2">
                    
                        </textarea>
                    </div>
                    <button class="btn btn-info" type="submit">送出</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require("script.php") ?>
  </body>
</html>

