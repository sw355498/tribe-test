<?php
require_once "php/db_connect_travel.php";

$product_id=$_GET["id"];
$sql="SELECT * FROM product WHERE id='$product_id'";
$result = $conn->query($sql);

?>
<!doctype html>
<html lang="en">
<head>
    <title>訂單查詢</title>
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
                <!-- <form action="updatecrudUser.php" method="post"> -->
                <?php  if ($result->num_rows > 0):
                    while($row = $result->fetch_assoc()) {
                    ?>
                    <input type="hidden" name="id" value="<?=$row["id"]?>">
            <div class="mb-2">
                <label>訂單編號:</label>
                <input type="text" class="form-control-plaintext" name="id" value="<?=$row["id"]?>" readonly>
            </div>
            <div class="mb-2">
                <label>行程名稱:</label>
                <span type="text" class="form-control-plaintext"><?=$row["name"]?></span>
            </div>
            <div class="mb-2">
                <label>金額(台幣):</label>
                <span type="text" class="form-control-plaintext"><?=$row["price"]?></span>
            </div>
            <div class="mb-2">
                <label>人數:</label>
                <span type="text" class="form-control-plaintext"><?=$row["number"]?></span>
            </div>
            <div class="mb-2">
                <label>行程規劃:</label>
                <span type="text" class="form-control-plaintext"><?=$row["itinerary"]?></span>
            </div>
            <div class="mb-2">
                <label>行程簡介:</label>
                <span type="text" class="form-control-plaintext"><?=$row["content"]?></span>
            </div>
            <!-- <button class="btn btn-info" type="submit">更新</button> -->
            <a class="btn btn-info" href="cruduser-list.php?id=<?=$row["id"]?>">確認</a>
     <?php
        }
        endif; ?>
    </form>
        </div>
    </div>
    
</div>
    
<?php require("script.php") ?>
</body>

</html>

