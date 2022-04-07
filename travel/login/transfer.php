<?php
require_once("pdo_connect_travel.php");

if(!isset($_POST["account"])){
    echo "請循正常管道進入";
    header("location:login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .body {
            background: #ffffff;
            width: 100%;
            height: 100%;
            margin-top: 1%;
            text-align: center;
        }

        .img {
            padding-top: 10%;
        }

        .body-h {
            letter-spacing: 20px;
            font-size: 40px;
            margin-left: 6%
        }

        img {
            width: 100px;
            ;
            margin: 30px;
            padding-left: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid container-fluid-bg">
        <div class="row">
            <nav class="header-top">
                <img src="../img/bult.png" class="logo" id="register-success-logo">
                <div style="float: right;display: none;" id="count-down">
                    <span style="padding-right: 30px"><label id="timedown">3</label>秒後將跳轉至主頁</span>
                  
                </div>
                
            </nav>
        </div>
    </div>
    <div class="container-fluid main">
        <div class="row">
            <div class="body">
                <div>
                    <img class="img" src="../img/success.png" alt="註冊成功">
                </div>
                <div>
                    <h3 class="body-h">註冊成功！</h3>
                </div>
                <a class="btn btn-light btn-md px-4 mx-3  " href="../member.php" role="button"> <i class="fas fa-sign-out-alt"></i>前往</a>
            </div>
           
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   
</body>

</html>