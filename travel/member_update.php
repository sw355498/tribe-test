<?php
require_once("php/pdo_connect_travel.php");

$id = $_GET["id"];

$stmt = $db_host->prepare("SELECT * FROM member WHERE id=?");
$stmt->execute([$id]);


try {
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // echo json_encode($rows);

} catch (PDOException $e) {
    echo "資料庫連結失敗<br>";
    echo "Error: " . $e->getMessage() . "<br>";
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>會員修改</title>
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
        .read-close-btn{
            justify-content: center;
            background: orangered;        
        }

        h3{
            font-weight: bold;
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
        <?php foreach ($rows as $value) { ?>
            <div class="browseModal container" id="browseModal">
                <div class="row justify-content-center">
                    <div class="col">
                        <form action="php/memberUpdate.php" method="post">
                            <h3 class="mx-2 mt-3 ">會員資料</h3>
                            <hr>
                            <div class="mb-2">
                                <input type="hidden" name="id" value="<?= $value["id"] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="memberName">姓名:</label>
                                <input type="text" class="form-control" name="name" id="memberName" value="<?= $value["name"] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="userAccount">帳號:</label>
                                <input name="account" type="text" class="form-control" id="userAccount" value="<?= $value["account"] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="userGender">性別:</label>
                                <input name='gender' type='radio'value='男' <?php if ($value['gender'] != '女') echo 'checked=checked;' ?> />男
                                <input type='radio' name='gender' value='女' <?php if ($value['gender'] == '女') echo 'checked=checked'; ?> />女

                            </div>
                            <div class="mb-2">
                                <label for="userBirth">生日:</label>
                                <input type="date" name="birth" class="form-control" id="userBirth" value="<?= $value["birth"] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="userPhone">電話:</label>
                                <input type="phone" name="phone" class="form-control" id="userPhone" value="<?= $value["phone"] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="userEmail">email:</label>
                                <input type="email" name="email" class="form-control" id="userEmail" value="<?= $value["email"] ?>">
                            </div>
                            <div class="mb-2">
                                <label for="points">點數</label>
                                <input type="number" name="points" class="form-control" id="points" value="<?= $value["points"] ?>">
                            </div>
                            <div class="row">

                            </div>
                            <div class="mb-2">
                                <label for="coupon">折價券</label>
                                <input type="number" name="coupon" class="form-control" value="<?= $value["coupon"] ?>">
                            </div>
                            <div>
                                <a href="member.php" type="button" class="btn btn-secondary read-close-btn">關閉</a>
                                <button type="submit" class="btn btn-secondary  read-close-btn">更改</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
        </div>
    </div>
</div>
    
<?php require("script.php") ?>
</body>

</html>

