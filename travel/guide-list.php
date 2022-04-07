<?php
// require_once "../db_travel.php";
require_once("php/pdo_connect_travel.php");

if(!isset($_GET["p"])){
    $p=1;
}else{
    $p=$_GET["p"];
}


$per_page=6;
$start_item=($p-1)*$per_page;

$sql="SELECT * FROM guide  WHERE valid=1 ORDER BY id DESC LIMIT $start_item, $per_page";
$stmt=$db_host->prepare($sql);

$sqlTotal="SELECT * FROM guide WHERE valid=1";
$resultTotal=$db_host->query($sqlTotal);
$total=$resultTotal->rowCount();
$pages= CEIL($total/$per_page);

try{
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $amount=$stmt->rowCount();
}catch(PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}

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
        <?php require("guide-header.php");?>
            <!-- 顯示搜尋的結果 -->
            <?php require("guide-table.php");?>
            <nav aria-label="Page navigation example d-flex">
                <ul class="pagination justify-content-center mt-4">
                    <!-- 用for迴圈跑出每頁的頁數 -->
                    <!-- 若i=p 就顯示active  ->表示現在正在第幾頁 -->
                    <?php for($i=1; $i<=$pages ; $i++){?>
                        <li class="page-item <?php if($i==$p)echo "active";?>"><a class="page-link" href="guide-list.php?p=<?=$i?>"><?=$i?></a></li>
                    <?php }?>
                </ul>
            </nav>  

            <!-- Modal 本體 -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <!-- Modal 頭部 -->
                        <div class="modal-header">
                            <h4 class="modal-title">新增導遊</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                    <!-- Modal 身部 -->
                        <div class="modal-body">
                            <?php require("create-guide-member.php");?>
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
        function confirmAct() 
        { 
        if(confirm('確定要執行刪除嗎?')) 
        { 
        return true; 
        } 
        return false; 
        } 



        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
        })
        // $('#delete_guide').on('show.bs.modal', function(e) {
        //     $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        // });

        //檢查有多少筆資料
        // let dataCount=$("tbody tr").length;
        // console.log(dataCount)

        // //每次點擊都計算tbody內的checkbox有幾個被勾選
        // $("tbody :checkbox").click(function(){
        //      //計算每次勾選數量
        //     let checkedCount=$("tbody :checked").length;
        //     // console.log(checkedCount)
        //     // $("tr").removeClass("active")
        //     // $(":checked").closest("tr").addClass("active")
            

            
            // let checked=$(this).prop("checked")
        //     //勾選數量=總筆數數量 全選就打勾
        //     if(checkedCount===dataCount){
        //         $("#checkAll").prop("checked", true)
        //     }else{
        //         $("#checkAll").prop("checked", false)
        //     }
        //     //點下去時,checked為true時  把我包著的tr 增加class
        //     //反之移除class
        //     if(checked){
        //         $(this).closest("tr").addClass("active")
        //     }else{
        //         $(this).closest("tr").removeClass("active")
        //     }
        // })

        // $("#checkAll").click(function(){
        //     let checked=$(this).prop("checked")
        //     $("tbody :checkbox").prop("checked", checked)
        //     if(checked){
        //         $("tbody tr").addClass("active")
        //         // tbody內的checkbox 全部勾選(true)
        //         // $("tbody :checkbox").prop("checked", true)
        //     }else{
        //         $("tbody tr").removeClass("active")
        //         // $("tbody :checkbox").prop("checked", false)
        //     }
        // })

        
        function reverseSelect() {
           $("#table").bootstrapTable('checkInvert');
        }
        function selectAll() {
           $("#table").bootstrapTable('checkAll');
        }
        

        // var rows= $("#table").bootstrapTable('getSelections');
        // console.log(rows);

        //全選刪除
        function deleteAll(){
            let ids= $('input[name="id[]"]');
            console.log(ids);
        }

  
    </script>

</body>

</html>

