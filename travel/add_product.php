<?php
require_once("php/pdo_connect_travel.php");

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
                        <label for="name">行程名稱<spand class="start_color">*</spand></label>
                        <input type="text" class="form-control" name="name" required placeholder="請輸入行程名稱">
                    </div>
                    <div class="mb-2">
                        <label for="price">行程價格<spand class="start_color">*</spand></label>
                        <input type="text" class="form-control" name="price" required placeholder="請輸入行程價格">
                    </div>
                    <div class="mb-2">
                        <label for="number">行程上架數量<spand class="start_color">*</spand></label>
                        <input type="text" class="form-control" name="number" required placeholder="請輸入行程上架數量">
                    </div>
                    <div class="mb-2">
                        <label for="attractions_id">地點標籤</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="viewpoint_id[]" placeholder="請輸入標籤景點代碼">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="viewpoint_id[]"  placeholder="請輸入標籤景點代碼">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="viewpoint_id[]"  placeholder="請輸入標籤景點代碼">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="viewpoint_id[]"  placeholder="請輸入標籤景點代碼">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="viewpoint_id[]"  placeholder="請輸入標籤景點代碼">
                            </div>                    
                        </div>               
                    </div>
                    <div class="mb-2">
                        <label for="itinerary">行程路線<spand class="start_color">*</spand></label>
                        <input type="text" class="form-control" name="itinerary" required  placeholder="請輸入行程路線 ex:太魯閣牌樓 → 太魯閣國家公園遊客中心→砂卡礑步道→小錐麓步道→燕子口→白楊步道 景觀台 ">
                    </div>
                    <div class="mb-2">
                        <label for="guide_id">帶隊導遊<spand class="start_color">*</spand></label>
                        <input type="text" class="form-control" name="guide_id" required placeholder="請輸入帶隊導遊代碼">
                    </div>
                    <div class="form-floating mb-2">
                        <label for="floatingTextarea2">行程介紹</label>
                        <textarea name="content" class="form-control"  id="floatingTextarea2" style="height: 300px"></textarea>
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

