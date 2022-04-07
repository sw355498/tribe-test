<?php


require_once("php/pdo_connect_travel.php");

if (!isset($_SESSION["user"])) {
    header("location:login/login.php");
}


$stmt = $db_host->prepare("SELECT * FROM member WHERE valid=1 ORDER BY id DESC");

try {
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "資料庫連結失敗<br>";
    echo "Error: " . $e->getMessage() . "<br>";
    exit;
}

//總會員數
$sql = "SELECT * FROM member WHERE valid=1";
$resultTotal = $db_host->prepare($sql);
$resultTotal->execute();
$total = $resultTotal->rowCount();




?>
<!doctype html>
<html lang="en">

<head>
    <title>會員列表</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

    <style type="text/css">
        .side-menu {
            height: 100%;
            /* nav隨著body內容撐高先用100vh滿版有需要再做更改 */
        }

        body {
            background: #eee;
            color: black;
            font-family: Microsoft JhengHei;
        }

        .wrapper {
            padding: 50px;
            text-align: center;
        }

        h2 {
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .left-head h2 {
            text-align: left;
        }



        .pic1 img {
            border-radius: 10px;
        }

        @media screen and (min-width: 768px) {
            .pic1 {

                margin: 0 auto;

            }

        }

        .page-title {
            margin-bottom: 25px;
            background: #eee;
        }

        .table-content {
            background: white;
        }

        .page-titles .breadcrumb li.active a {
            color: #3B4CB8;
            font-weight: 600;

        }

        .page-titles .breadcrumb-item a {
            text-decoration: none;
        }

        /* 點到超連結變手指 */
        a:-webkit-any-link {
            color: -webkit-link;
            cursor: pointer;
            text-decoration: underline;
        }

        .buttons {
            display: flex;
            /* align-items: center; */
            justify-content: center;
            flex-direction: column;
        }


        .email {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }


        .create {
            margin: 10px 0;
            float: right;
        }


        .logout {
            position: absolute;
            top: 0%;
            right: 0;
            display: flex;
        }

        .table-content img {
            border-radius: 50px;
        }

        .table td {
            vertical-align: middle;
        }

        .create {
            text-align: left;
        }

        .browseModal {
            position: fixed;
            top: 3%;
            left: 36%;
            width: 30%;
            z-index: 10;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            display: none;
        }

        .browseModal .text {
            position: relative;
            max-width: 498px;
            width: 100%;
        }

        .browseModal .btn-close {
            position: absolute;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            text-decoration: none;
            top: 10px;
            right: 0;
        }

        #memberBrowse {
            margin-right: 5px;
        }

        a,
        a:link,
        a:visited {
            text-decoration: none;
            color: black;
        }

        /* 分頁jquerycss */

        .rb_bottom,
        .rb_bottom .fy_y,
        .rb_bottom .pnbtn,
        .rb_bottom .previous,
        .rb_bottom .next {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .fy_y {
            width: 24px;
            height: 24px;
            box-sizing: border-box;
            background: #fff;
            border: 1px solid #7baaa0;
            border-radius: 50%;
            color: #4f4f4f;
            font-size: 14px;
            font-weight: 500;
            margin-right: 12px;
            cursor: pointer;
        }

        .fy_d {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #fff;
            margin-right: 12px;
        }

        .selected {
            background: #164c86;
            color: #fff;
            border: 0;
        }

        .pnbtn,
        .previous,
        .next {
            width: 62px;
            height: 31px;
            box-sizing: border-box;
            border: 3px solid #fff;
            border-radius: 10px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            color: #fff;
        }

        .previous {
            margin: 0 2px;
        }

        .total {
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: 900;
            letter-spacing: 3px;
        }

        #example_length {
            text-align: left;
        }

        #example_info {
            text-align: left;
        }

        .wrapper {
            font-weight: bold;
        }

        #example {
            font-weight: bold;
        }

        label.xrequired:before {
            content: '* ';
            color: red;
        }

        .remind {
            font-size: 12px;
            margin-bottom: 5px;
            margin: 0 auto;
        }

        .pnbtn,
        .previous,
        .next {
            border:none;
            margin: 0 4px;
            width: 74px;
            height: 38px;
            box-sizing: none;
            /* border: 3px solid #fff; */
            /* border-radius: 10px; */
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            color: #fff;
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
                <div class="container-fluid">

                    <div class="row wrapper">

                        <div class="col-md-12">
                            <div class="d-flex page-titles">
                                <div class="ml-auto d-md-block col right-head d-flex flex-end">



                                    <div class="create">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="fa fa-user m-2"></i>新增會員
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">新增會員</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="php/memberCreate.php" method="post">
                                                            <label for="name" class="xrequired  fw-bold remind">為必填欄位</label>
                                                            <div class="mb-2">
                                                                <label for="name" class="xrequired">名字 :</label>
                                                                <input class="form-control" type="text" id="name" name="name" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="account" class="xrequired">帳號 :</label>
                                                                <input class="form-control " type="text" id="account" name="account" required>
                                                            </div>
                                                            <div class="mb-2 xrequired">
                                                                <label for="gender">性別 :</label>
                                                                <input type="radio" id="male" name="gender" value="男" class="ml-2" checked>男
                                                                <input type="radio" id="female" name="gender" value="女" class="ml-2">女
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="date" class="xrequired">生日 :</label>
                                                                <input class="form-control" type="date" id="birth" name="birth" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="phone" class="xrequired">電話 :</label>
                                                                <input class="form-control" type="tel" id="phone" name="phone" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="email" class="xrequired">Email :</label>
                                                                <input class="form-control" type="email" id="email" name="email" required>
                                                            </div>
                                                            <div class="mb-2">
                                                                <label for="number">點數:</label>
                                                                <input class="form-control" type="text" id="points" name="points">
                                                            </div>

                                                            <div class="mb-2">
                                                                <label for="number">折價券:</label>
                                                                <input class="form-control" type="number" id="coupon" name="coupon">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                                                                <button type="submit" class="btn btn-primary">送出</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-content ">
                                <div class="wrapper">

                                    <table class="table table-striped table-hover display" id="example">
                                        <span class="p-2 text-nowrap total d-flex">
                                            共<?= $resultTotal->rowCount() ?>筆會員
                                        </span>
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-nowrap">編號</th>
                                                <th scope="col" class="text-nowrap">姓名</th>
                                                <th scope="col" class="text-nowrap">性別</th>
                                                <th scope="col" class="text-nowrap">電話</th>
                                                <th scope="col" class="text-nowrap">email</th>
                                                <th scope="col" class="text-nowrap">功能</th>
                                            </tr>
                                        </thead>

                                        <tbody id="myTable">
                                            <?php foreach ($rows as $value) { ?>
                                                <tr>
                                                    <td><?= $value["id"] ?></td>
                                                    <td><?= $value["name"] ?></td>
                                                    <td><?= $value["gender"] ?></td>
                                                    <td><?= $value["phone"] ?></td>
                                                    <td><?= $value["email"] ?></td>
                                                    <td class="function text-nowrap">

                                                        <a href="member_read.php?id=<?= $value["id"] ?>" class="text-white btn btn-info btn-md mb-2 text-nowrap"><i class="fa fa-eye"></i>瀏覽</a>

                                                        <a class="btn btn-warning btn-md mb-2 text-nowrap" href="member_update.php?id=<?= $value["id"] ?>" id=""><i class="fas fa-pen"></i></i>修改</a>

                                                        <a class="text-white btn btn-danger btn-md mb-2 text-nowrap" href="php/memberDelete.php?id=<?= $value["id"] ?>" id=""><i class="fa fa-trash"></i>刪除</a>
                                                    </td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
    </div>

    <?php require("script.php") ?>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#example').DataTable({
                "language": {
                    "processing": "處理中...",
                    "loadingRecords": "載入中...",
                    "lengthMenu": "顯示 _MENU_ 項結果",
                    "zeroRecords": "沒有符合的結果",
                    "info": "顯示第 _START_ 至 _END_ 項結果，共 _TOTAL_ 項",
                    "infoEmpty": "顯示第 0 至 0 項結果，共 0 項",
                    "infoFiltered": "(從 _MAX_ 項結果中過濾)",
                    "infoPostFix": "",
                    "search": "搜尋:",
                    "paginate": {
                        "first": "第一頁",
                        "previous": "上一頁",
                        "next": "下一頁",
                        "last": "最後一頁"
                    },
                    "aria": {
                        "sortAscending": ": 升冪排列",
                        "sortDescending": ": 降冪排列"
                    }
                },
                pagingType: 'full_numbers',
                order: [
                    [0, 'desc'],
                ],
                'iDisplayLength': 6,
                "aLengthMenu": [
                    [6, 25, 50, -1],
                    [6, 25, 50, "All"]
                ]
            });
        });
    </script>
</body>

</html>