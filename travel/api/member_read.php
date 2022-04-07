<?php
require_once("travel_connect.php");

$id=$_GET["id"];

$stmt = $db_host->prepare("SELECT * FROM member WHERE id=?");
$stmt ->execute([$id]);


try {
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // echo json_encode($rows);

} catch (PDOException $e) {
    echo "資料庫連結失敗<br>";
    echo "Error: " . $e->getMessage() . "<br>";
    exit;
}
?>

<?php require_once("header.php");?>
  <?php foreach ($rows as $value) { ?>
        <div class="browseModal container" id="">
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
                        <input type="radio" id="male" name="gender" value="<?= $value["gender"] ?>" class="ml-2">男
                        <input type="radio" id="female" name="gender" value="<?= $value["gender"] ?>" class="ml-2">女
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
                    <div class="mb-2">
                        <label for="coupon">折價券</label>
                        <input type="number" name="coupon" class="form-control" value="<?= $value["coupon"] ?>">
                    </div>
                    <div>
                        <a href="member.php" type="button" class="btn btn-secondary d-flex read-close-btn">關閉</a>
                        <button type="submit" class="btn btn-secondary  read-close-btn">更改</button>
                    </div>
                </form>

            </div>
        </div>
        </div>
    <?php } ?>
    </div>
    <?php require_once("footer.php");?>