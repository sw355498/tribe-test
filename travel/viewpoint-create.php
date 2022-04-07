<?php
require_once("php/pdo_connect_travel.php");

$p=$_SERVER['HTTP_REFERER'];//上一頁

//取出area的關聯表資料
$sqlArea="SELECT * FROM area";
$resultArea=$db_host->prepare($sqlArea);
$resultArea->execute();
$rowArea=$resultArea->fetchAll(PDO::FETCH_ASSOC);


//取出topic的關聯表資料
$sqlTopic="SELECT * FROM topic";
$resultTopic=$db_host->prepare($sqlTopic);
$resultTopic->execute();
$rowTopic=$resultTopic->fetchAll(PDO::FETCH_ASSOC);


?>

<!doctype html>
<html lang="en">
<head>
    <title>新增景點</title>
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
        .error {
          color: #FF0000;
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

                    <!-- table -->
                    <form 
                    id="form" name="form" class="needs-validation row  justify-content-center" action="php/viewpointCreate.php" method="post" enctype="multipart/form-data"  novalidate >

                    <!-- 景點名稱 -->
            
                            <div class="my-3 col-10">
                                <label for="name " class="form-label font-weight-bold" for="">景點名稱：</label>
                                <div class="error " ><small>*必填</small></div>
                                <input class="form-control " type="text" name="name" id="name" required>
                                <div class="invalid-feedback">
                                    請填寫景點名稱
                                </div>
                            </div>

                    <!-- 景點地區 -->
                            <div class="mt-4 col-5">
                                <label class="form-label font-weight-bold"  for="">景點地區：</label>
                                <div>
                                <select class="custom-select mb-1" name="area" > 
                            <?php foreach ($rowArea as $area) {  ?>         
                                <option value="<?=$area["id"]?>" name=""><?=$area["name"]?></option>
                            <?php }?>
                                </select> 
                                </div>
                            </div>

                    <!-- 景點主題 -->
                            <div class="mt-4 col-5">
                                <label class="form-label font-weight-bold" for="">景點主題：</label>
                            <div>
                                <select class="custom-select mb-1" name="topic" >
                            <?php foreach ($rowTopic as $topic) {  ?>         
                                <option  value="<?=$topic["id"]?>" ><?=$topic["name"] ?></option>
                            <?php }?>
                                </select>
                            </div>    
                            </div>

                    <!-- 景點介紹 -->
                            <div class="mt-5 col-10">
                    
                                <label class="form-label group required font-weight-bold" for="intro">景點介紹：</label>
                                <div class="error" ><small>*必填</small></div>
                                <textarea  class="form-control" name="intro" id="intro" cols="30" rows="6" required></textarea>
                                <div class="invalid-feedback">
                                    請填寫景點介紹
                                </div>
                            </div>

                    <!-- 景點評論 -->
                            <div class="mt-5 col-10">
                                <label class="form-label group required font-weight-bold" for="review">景點評論：</label>
                                <div class="error"><small>*必填</small></div>
                                <textarea  class="form-control" name="review" id="review" cols="30" rows="4" required></textarea>
                                <div class="invalid-feedback">
                                    請填寫景點評論
                                </div>
                            </div>


                    <!-- 景點圖片 -->
                            <div class="mt-5 col-10">
                                <label for="file[]"class="formFileMultiple font-weight-bold">選擇景點圖片：
                
                                </label>
                                <div class="error"><small>*必填</small></div>
                                <input class="form-control " type="file" name="file[]" multiple id="formFileMultiple" value="選擇圖片" required
                                style="height:60px; align-item-center"
                                >
                                <div class="invalid-feedback">
                                    請選擇圖片
                                </div>

                                <!-- <?php foreach($rows as $value) { ?>
                                    <div class="col-md-3">
                                        <img class="img-fluid"src="../pic/<?=$value["img_src"]?>" alt="">
                                    </div>
                                <?php  } ?>
                            </div>  -->
                            
                        <!-- buttons -->

                            <div class="d-flex justify-content-between mt-5">
                                <a class="btn btn-success" href="viewpoint-list.php"> 返回</a>
                                <div>
                                    <input type="submit" class="btn btn-info mx-3" name="submit" id="submit" value="送出"></input>
                                    <button type="reset" class="btn btn-secondary" name="reset">重置</button>
                                </div>
                            </div>
                        </form>
                    </div>

        </div>
        <?php 
            //  echo $_SERVER["HTTP_REFERER"].$_SERVER["QUERY_STRING"]?> 
            <!-- <?php echo $_SERVER['HTTP_REFERER'].$_SERVER["QUERY_STRING"]  ?> -->
    </div>
</div>
    
<?php require("script.php") ?>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

// Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

// Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
</body>

</html>

