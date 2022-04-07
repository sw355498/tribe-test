<?php
// require_once "../db_travel.php";


// $id=$_GET["id"];
// if(!isset($_GET["id"])){
//     $id=1;
// }else{
//     $id=$_GET["id"];
// }
// $sql="SELECT * FROM member WHERE id='$id'";
// $result = $conn->query($sql);

require_once("php/pdo_connect_travel.php");

//member 資料表
$sql="SELECT * FROM member  WHERE valid=1";
$stmt=$db_host->prepare($sql);
try{
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $amount=$stmt->rowCount();
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}

//guide資料表
$sqlGuide="SELECT * FROM guide  WHERE valid=1";
$stmt_guide=$db_host->prepare($sqlGuide);
try{
    $stmt_guide->execute();
    $rows_guide = $stmt_guide->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}

//語言資料表

$stmtLanguage=$db_host->prepare("SELECT * FROM language");
try{
    $stmtLanguage->execute();
    $rowsLanguage=$stmtLanguage->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOExecption $e){
    echo "讀取資料失敗";
}


// $sql="SELECT guide.*, member.name As member_name ,  member.phone As member_phone , member.email As member_email FROM guide JOIN member ON guide.member_id = member.id";
// $stmt=$db_host->prepare($sql);
// try{
//     $stmt->execute();
//     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     $amount=$stmt->rowCount();
// }catch(PDOException $e){
//     echo "資料庫連結失敗<br>";
//     echo "Error: ".$e->getMessage(). "<br>";
//     exit;
// }



// $sql="SELECT guide.*, member.name As member_name ,  member.phone As member_phone , member.email As member_email FROM guide JOIN member ON guide.member_id = member.id";

// $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新增導遊</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

</head>
<style>
    .note{
        font-size:12px;
    }
    select {   
        color: rgb(52,58,64);
        width: 435px;
        height: 40px;   
        border-radius: 5px;
        border:1px #ccc solid;    
        }
</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
            <form action="guideCreate.php" method="post" enctype="multipart/form-data">
            <?php 
                $stmt=$db_host->prepare("SELECT * FROM member");
                try{
                    $stmt->execute();
                    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
                }catch(PDOExecption $e){
                    echo "讀取資料失敗";
                }
                //  $id=$_POST["id"]; ?>
                    <span class="text-danger note">*為必填</span>
                    <div class="my-2">
                        <select name="member" id="member_id">
                            <option>&nbsp會員編號</option> 
                            <?php foreach($rows as $value){ ?>
                            <option value="<?=$value["id"]?>">&nbsp會員編號&nbsp<?=$value["id"]?>：<span><?=$value["name"]?></option>
                            <?php } ?>
                            </select>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="name"><span class="text-danger">*</span>姓名</label>
                        <input class="form-control" type="text" id="name" name="name"? placeholder="請輸入姓名" required>
                    </div>
                    <div class="mb-2">
                        <label for="phone"><span class="text-danger">*</span>電話</label>
                        <input class="form-control" type="text" id="phone" name="phone"? placeholder="請輸入電話" required>
                    </div>
                    <div class="mb-2">
                        <label for="email"><span class="text-danger">*</span>email</label>
                        <input class="form-control" type="email" id="email" name="email"? placeholder="請輸入e-mail"  required>
                    </div>
                    <div class="mb-2">
                        <label for="gender"><span class="text-danger">*</span>性別</label>
                        <input class="form-control" type="text" id="gender" name="gender"? placeholder="請輸入男或女" required>
                    </div>
                    <!-- <div class="mb-2">
                        <label for=""><span class="text-danger">*</span>性別</label>
                        <input type="radio" name="gender" value="男" checked> 男性
                        <input type="radio" name="gender" value="女"> 女性
                    </div> -->
                    </div>
                    <div class="mb-2">
                    <label for="goodat">專長</label>
                    <input class="form-control" type="text" id="goodat" name="goodat" placeholder="請輸入專長 ( ex: 登山)"> 
                    </div>
                    <div class="mb-2">
                        <label for="certificate"><span class="text-danger">*</span>證照</label>
                        <input class="form-control" type="text" id="certificate" placeholder="請輸入證照 ( ex: 華語導遊 甲級溯溪..等)"name="certificate" required>
                    </div>                    
                    <div class="mb-2">
                    <label for="language"><span class="text-danger">*</span>語言</label>
                    <?php foreach($rowsLanguage as $value){  ?>
                        <input type="checkbox" name="language[]" value="<?=$value["id"]?>"><label for=""><?=$value["name"]?></label>
                    <?php } ?>
                    </div>             
                    <div class="mb-2">
                        <label for="intro"><span class="text-danger">*</span>自我介紹</label>
                        <textarea class="form-control"  id="intro" rows="5" name="intro" placeholder="請輸入自我介紹 (最多300字)" maxlength="300" required ></textarea>
                    </div>                    
                    <div class="mb-2">
                        <label for="bank_account"><span class="text-danger">*</span>匯款帳號</label>
                        <input class="form-control" type="text" id="bank_account" placeholder="請輸入匯款帳號" name="bank_account" required>
                    </div>                    
                    <div class="mb-2">                   
                    <label for="">選擇檔案</label>
                    <input type="file" name="file">
                    </div>
                    <div class="mb-2">
                    <button class="btn btn-info" type="submit" id="button">新增</button>
                    <a href="guide-list.php" class=" btn btn-secondary">
                        Close
                    </a>
                    </div>
                    </form>
                </div>   
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>

    // axios.get('/travel/users.php')
    //       .then(function(response){
    //         console.log(response.data)
            
    //       })
    //       .catch(function(error){
    //         console.log(error)
    //       });


       
        // $("#member_id").change(function(){
        //     // const id = $('#member_id option:selected').val()
        //     // let id="6";     
        //   axios.get('/travel/users.php')
        // //   console.log(id)  
        //   .then(function(response){
        //     let id = $('#member_id option:selected').val()
        //     // let id="6";
        //     console.log(id)
        //     let member = response.data.filter(item=>item.id===id)[0]
        //     console.log(member)
        //     $('#name').val(member.name)
        //     $('#email').val(member.email)
        //     $('#phone').val(member.phone)

        // })
        //   .catch(function(error){
        //     console.log(error)
        //   });
        // })


        let members=<?=json_encode($rows)?>;

        $("#member_id").change(function(){
        let id=$(this).val();
        let member=members.find((member)=>{
            return member.id===id;
        })
        $("#name").val(member.name);
        $("#email").val(member.email);
        $('#phone').val(member.phone);
        $('#gender').val(member.gender);

        
        })

        $("#button").click(function(){
			var check=$("input[name='language[]']:checked").length;//判斷有多少個方框被勾選
			if(check==0){
				alert("請勾選語言");
				return false;//不要提交表單
			}else{
				// alert("你勾選了"+check+"種語言");
				return true;//提交表單
			}
		})

  </script>
</body>
</html>