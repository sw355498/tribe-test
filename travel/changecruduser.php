<?php
require_once "php/db_connect_travel.php";

$id = $_GET["id"];
$sql = "SELECT product.name as name,content,itinerary, order_detail.id as id ,
order_detail.price as price,order_detail.number as number FROM product join order_detail on order_detail.product_id=product.id 
 WHERE order_detail.id='$id'";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>訂單修改</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
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

    

    <!--content stfill bd-highlight p-0">
        <div class="art-->
    <div class="flex- bg-light p-4" style="min-height:100vh ">
            <form action="php/updatecruduser.php" method="post">
            <?php if ($result->num_rows > 0) :
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                            <div class="mb-2">
                                <label>訂單編號:</label>
                                <input type="text" class="form-control-plaintext" name="id" value="<?= $row["id"] ?>" readonly>
                            </div>
                            <div class="mb-2">
                                <label>行程名稱:</label>
                                <span type="text" class="form-control-plaintext"><?= $row["name"] ?></span>
                            </div>
                            
                            <div class="mb-2">
                                <label>人數:</label>
                                <!-- <span><?= $row["number"] ?></span> -->
                                <input type="text" class="form-control" name="number" value="<?= $row["number"] ?>">
                            </div>
                            <div class="mb-2">
                <label>行程規劃:</label>
                <span type="text" class="form-control-plaintext"><?=$row["itinerary"]?></span>
            </div>
            <div class="mb-2">
                <label>行程簡介:</label>
                <span type="text" class="form-control-plaintext"><?=$row["content"]?></span>
            </div>
            <div class="mb-2">
                <label for="">備註欄: </label>
                <input type="text" class="form-control" name="others"  >
            </div>
                            <!-- <div class="mb-2">
                                <label>行程規劃:</label>
                                <span type="text" class="form-control-plaintext"><?= $row["itinerary"] ?></span>
                            </div>
                            <div class="mb-2">
                                <label>行程簡介:</label>
                                <span type="text" class="form-control-plaintext"><?= $row["content"] ?></span>
                            </div> -->
                            <button class="btn btn-info" type="submit"  >更新</button>
                            
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

