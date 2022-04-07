<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>َ新增後臺帳號</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

</head>

<style>
  ::placeholder {
    color: white;
    opacity: .5;
    /* Firefox */
  }

  body {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
    background: #34495e;
    background-image: url("https://picsum.photos/1400/1200");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    background-size: cover;
  }

  .box {
    width: 300px;
    padding: 40px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #191919;
    text-align: center;
    background-color: rgba(0, 0, 0, .6);
  }

  .box h1 {
    color: white;
    text-transform: uppercase;
    font-weight: 500;
  }

  .box input[type="text"],
  .box input[type="password"] {
    border: 0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #3498db;
    padding: 14px 10px;
    width: 200px;
    outline: none;
    color: white;
    border-radius: 24px;
    transition: 0.25s;
  }

  .box input[type="text"]:focus,
  .box input[type="password"]:focus {
    width: 280px;
    border-color: #2ecc71;
  }

  .box input[type="submit"] {
    border: 0;
    background: none;
    display: block;
    margin: 20px auto;
    text-align: center;
    border: 2px solid #2ecc71;
    padding: 14px 40px;
    outline: none;
    color: white;
    border-radius: 24px;
    transition: 0.25s;
    cursor: pointer;
  }

  .box input[type="submit"]:hover {
    background: #2ecc71;
  }

  #form {
    border-radius: 10px;
  }

  .mistake {
    color: red;
  }


  #form {
    border-radius: 10px;


  }

  *,
  ::after,
  ::before {
    box-sizing: content-box !important;
  }
</style>

<body>




  <form class="box" method="post" action="userCreate.php" id="form">
    <h1 class="text-center"><small class="text-light">註冊</small></h1>
    <div class="">
              <input type="text" class="form-control" id="account" placeholder="請輸入 4~8 碼帳號" name="account" required>
              <small class="text-danger" id="accountMsg"></small>
            </div>

    <input type="password" class="form-control" id="password" name="password" placeholder="請設定您的密碼" required>
    <div class="invalid-feedback">密碼有誤，請再次輸入密碼</div>

    <input type="password" class="form-control" id="repassword" name="repassword" placeholder="請再次輸入你的密碼" required>

    <div class="invalid-feedback">密碼有誤，請再次輸入密碼</div>
    <input type="submit" name="" value="確認註冊" id="sign">

  </form>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>
    $("#account").on({
      "change": function() {
        // console.log("change")
        $("#accountMsg").text("");
        let account = $(this).val();
        let formdata = new FormData();
        formdata.append("account", account);

        axios.post('../php/check_username.php', formdata)
          .then(function(response) {
            console.log(response);
            if (response.data.count === 1) {
         
              $("#accountMsg").text("這個帳號已經有人註冊過了")
            }
          })
          .catch(function(error) {
            console.log(error);
          });
      },
      "keyup": function() {
        $("#accountMsg").text("");
        let accountLength = $(this).val().length;
        if (accountLength < 4) {
          $("#accountMsg").text("帳號太短")
        } else if (accountLength > 8) {
          $("#accountMsg").text("帳號太長")
        }
      }
    })

    $("#sign").click(function(e) {
      e.preventDefault();
      let passContent = $("#password").val();
      let repassContent = $("#repassword").val();
      let passLength=$("#password").val().length;
      if(passLength >= 1){
        if (passContent === repassContent) {
          // alert("密碼一致")
          $("form").submit();
        } else {
          $("#password").addClass('is-invalid');
          $("#repassword").addClass('is-invalid');
          alert("前後密碼不一致")
        }
      }else{
        alert("請輸入密碼")
      }
    })
  </script>
</body>

</html>