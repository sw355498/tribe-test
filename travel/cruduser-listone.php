<?php
require_once "php/db_connect_travel.php";

$name=$_GET["name"];



$sql = "SELECT order_detail.id as order_detail_id,product.id as product_id
,itinerary
,product.name as product_name,buy_time,order_detail.name as name
,product.status,(product.price)/(Currency_buy) as price,total
,order_detail.number as number ,date_end,date_start
,currency_buy,currency_name
 FROM order_detail left JOIN product ON
 order_detail.product_id = product.id 
  join currency on  currency.id=order_detail.currency_id
 where order_detail.name ='$name'  ORDER BY 1";


$result = $conn->query($sql);


?>
<!doctype html>
<html lang="en">
<head>
    <title>導遊列表</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="css/bootstrap 4.3.1.min.css" rel="stylesheet">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap 4.3.1.min.js"></script>
    <link href="css/travel_style.css" rel="stylesheet"> 
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
            <div class="d-flex justify-content-between py-2">
            <div class="">共有 <?= $result->num_rows ?> 筆行程</div>

</div>
<?php
// if ($result->num_rows > 0) {
// output data of each row
//fetch_assoc() 將讀出的資料Key值設定為該欄位的欄位名稱。
//     while($row = $result->fetch_assoc()) {
//       echo "id: " . $row["id"]. " : 姓名: " . $row["name"]. ", 電話: " . $row["phone"]. ", email: ".$row["email"]."<br>";
//     }
//   } else {
//   echo "目前沒有使用者";
//   }


?>

<table class="table table-bordered table-sm">
    <form action="order.php" method="post"><button class="btn btn-info" type="submit">新增行程 </button></form>

    <thead>
        <tr>
            <th>行程編號</th>
            <!-- <th>行程序號</th> -->
            <th>購買時間</th>
            <th>旅遊開始日期</th>
            <th>旅遊結束日期</th>
            <th>姓名</th>
            <!-- <th>是否有效</th> -->
            <th>行程規劃</th>
            <th>人數</th>
            <th>金額(位)</th>
            <th>總金額</th>

            <th>瀏覽行程</th>
            <th>修改行程</th>
            <th>刪除行程</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0) :
            while ($row = $result->fetch_assoc()) {
        ?>

                <tr>
                    <td><?php echo $row["order_detail_id"] ?></td>
                   
                    <td><?= $row["buy_time"] ?></td>
                    <td><?= $row["date_start"] ?></td>
                    <td><?= $row["date_end"] ?></td>
                    <td><?= $row["name"] ?></td>
                    <td><?= $row["itinerary"] ?></td>
                    <td><?= $row["number"] ?></td>
                    <td><?= sprintf("%.3f", ($row["price"] )).$row["currency_name"]  ?></td>
                    <td><?= floor ($row["price"] * $row["number"]).$row["currency_name"]  ?></td>

                    <td><a class="btn btn-info" href="cruduser.php?id=<?= $row["product_id"] ?>">瀏覽</a></td>
                    <td><a class="btn btn-info" href="changecruduser.php?id=<?= $row["order_detail_id"] ?>">修改</a></td>
                    <td><a class="btn btn-info" href="deletecruduser.php?id=<?= $row["order_detail_id"] ?>">刪除</a></td>
                </tr>
            <?php
            }
        else : ?>


        <?php endif; ?>
    </tbody>
</table>
</div>
</div>


</div>
    
<?php require("script.php") ?>
</body>

</html>

