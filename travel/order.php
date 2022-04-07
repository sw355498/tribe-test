<?php
require_once "php/db_connect_travel.php";



$sql = "SELECT product.id, product.name as product_name,buy_time,order_detail.name as name,product.status,product.price,total,product.number FROM order_detail  
JOIN product ON order_detail.id = product.id 
join user on order_detail.user_id=user.id
where status= '1'  ";
$result = $conn->query($sql);





?>

<?php
// echo '<select name="name">
// <option>行程</option>';

// $sql = "SELECT name FROM product";
// $result = mysqli_query($conn, $sql);
// while ($row = mysqli_fetch_array($result)) {
//     echo '<option>' . $row['name'] . '</option>';
// }

// echo '</select>';

?>

<!doctype html>
<html lang="en">
<head>
    <title>使用者訂單新增</title>
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
            <form action="insert-order.php" method="get">
            <div class="mb-2">
                <label name="product_name for=">行程
            </div>
            
            <?php
            echo '<select name="id">
            <option>選擇行程</option>';

            $sql = "SELECT itinerary ,id FROM product";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                echo "<option value='" . $row["id"] . "  '>" . $row["itinerary"] . "</option>";
            }

            echo '</select>';

            ?>
                       
        
        </label>
            <!-- <input type="text" class="form-control" name="product_name" required> -->

            <div class="mb-2">
                <label for="">姓名</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            
            <div class="mb-2">
                <label for="">人數</label>
                <input type="text" class="form-control" name="number" required>
            </div>
            <div class="mb-2">
                <label name="currency_name for=">選擇幣值:
            
            
            <?php
            echo '<select name="currency_id">
            <option>選擇幣值</option>';

            $sql = "SELECT currency_name,id FROM currency";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                echo "<option value='" . $row["id"] . "  '>" . $row["currency_name"] . "</option>";
            }

            echo '</select>';

            ?>
                       
        
        </label>
        </div>
            <!-- <div class="mb-2">
                <label for="">總金額(位)</label>
                <input type="text" class="form-control" name="price"  readonly>
            </div> -->
            <div class="mb-2">
                        <label for="date">出發日期:</label>
                        <input type="date" name="date_start" class="form-control" id="date_start" required value="<?= $value["date_start"] ?>">
                    </div>
                    <div class="mb-2">
                        <label for="date">結束日期:</label>
                        <input type="date" name="date_end" class="form-control" id="date_end" required value="<?= $value["date_end"] ?>">
                    </div>

                    <!-- <div class="mb-2">
                <label for="">付款方式</label> -->
                 
            <?php
            // echo '<select name="buy_way">
            // <option>選擇行程</option>';

            // $sql = "SELECT buy_way FROM order";
            // $result = mysqli_query($conn, $sql);
            // while ($row = mysqli_fetch_array($result)) {
            //     echo "<option value='" . $row["id"] . "  '>" . $row["buy_way"] . "</option>";
            // }

            // echo '</select>';

            ?>
               
            <!-- </div> -->
                   
           


        <div class="mb-2">
                <label for="">備註欄: </label>
                <input type="text" class="form-control" name="others"  >
            </div>
            <button class="btn btn-info" type="submit" >送出</button>
        </form>
    </div>
    
<?php require("script.php") ?>
</body>

</html>

