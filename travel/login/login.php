<?php
require_once("pdo_connect_travel.php");
if (isset($_SESSION["user"])) {
  header("location:../member.php");
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>َ登入畫面</title>

</head>

<style>
  ::placeholder {
  color: white;
  opacity: .5; /* Firefox */
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
</style>

<body>

  <form class="box" action="doLogin.php" method="post" id="form">
    <?php if (isset($_SESSION["error"]) && $_SESSION["error"]["times"] > 5) : ?>
      <h1>登入</h1>
      <div class="mistake">您嘗試的登入錯誤次數過多，請稍後再來</div>
    <?php else : ?>
      <h1>登入</h1>
      <input type="text" placeholder="帳號" id="account" name="account" required>
      <input type="password" name="password" placeholder="密碼" id="password" required>
      <?php if (isset($_SESSION["error"])) : ?>
        <div class="mb-2">
          <small class="mistake"><?php echo $_SESSION["error"]["message"] ?>,登入錯誤次數<?php echo $_SESSION["error"]["times"] ?></small>
        </div>
      <?php endif;  ?>

      <input type="submit" name="" value="登入" id="login">
  </form>
<?php endif; ?>

</body>

</html>