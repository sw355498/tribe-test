<table id="table" class="table table-bordered table-striped table-sm"
    data-toggle="table"
    data-sortable="true"
    data-sort-class="table-active"
    data-show-columns="true"
    data-show-columns-toggle-all="true"
>
                <thead class="table-dark">
                    <tr>
                        <th class="text-center" data-sortable="true">導遊<br>編號</th>
                        <th class="text-center align-middle">照片</th>
                        <th class="text-center align-middle">姓名</th>
                        <th class="text-center align-middle">電話</th>
                        <th class="text-center align-middle">Email</th>
                        <th class="text-center align-middle" data-field="gender" data-sortable="true">性別</th>
                        <th class="text-center align-middle">專長</th>
                        <th class="text-center align-middle">證照</th>
                        <th class="text-center align-middle">語言</th>
                        <th class="text-center align-middle">管理</th>
                    </tr>
                </thead>
                <tbody>
                    <!--第一層迴圈:撈出每一個會員的全部資料-->
                    <?php foreach($rows as $value){ ?>
                        <tr>
                            <td>
                                <span  class="d-inline-block" style="max-width:5px;">
                                    <?= $value["id"] ?>
                                </span>
                            </td>
                            <td class="photo">
                                <img class="img-fluid rounded" src="upload/<?= $value["picture"]?>" alt="" class=""></td>
                            <td>
                                <span  class="d-inline-block  align-middle" style="max-width:50px;">
                                    <?= $value["name"]?>
                                </span>
                            </td>
                            <td>
                                <span  class="d-inline-block  align-middle" style="max-width:100px;">
                                    <?= $value["phone"]?></td>
                                </span>
                            <td>
                                <span  class="d-inline-block text-truncate align-middle" style="max-width:180px;">
                                    <?= $value["email"] ?>
                                </span>
                            </td>
                            <td>
                                <span  class="d-inline-block  align-middle" style="max-width:10px;">
                                    <?= $value["gender"]?></td>
                                </span>
                            <td>
                                <span  class="d-inline-block  align-middle" style="max-width:80px;">
                                    <?= $value["goodat"]?>
                                </span>
                            </td>
                            <td>
                                <span class="d-inline-block  align-middle" style="max-width:100px;">
                                    <?= $value["certificate"]?>
                                </span>
                            </td>
                            <td>
                                <span class="d-inline-block  align-middle" style="max-width:80px;">
                                    <?php
                                    /* 用explode將language欄位字串拆分為陣列 */
                                    $a=explode(",",$value["language"]);
                                    /* 第二層迴圈：將language欄位拆分出的陣列,各別撈出比對language資料表的id */
                                    foreach($a as $b){
                                        $stmt_language=$db_host->prepare("SELECT * FROM language WHERE id=?");
                                        $stmt_language->execute([$b]);
                                        $rows_language = $stmt_language->fetchAll(PDO::FETCH_ASSOC);
                                        /* 第三層迴圈：撈出各別language的name */
                                        foreach($rows_language as $c){                            
                                    ?>
                                            <?= $c["name"]?>
                                        <?php }?>
                                    <?php }?>
                                </span>
                            </td>
                            <td class="text-nowrap";> 
                                <span class="d-inline-block  align-middle d-flex justify-content-evenly">
                                    <a class="btn btn-info ml-2" href="guide-read.php?id=<?= $value["id"]?>"><i class="fa fa-eye"></i><span class="mx-1">瀏覽</a>
                                    <a class="btn btn-warning ml-2" href="guide.php?id=<?= $value["id"]?>"><i class="fas fa-pen"></i><span class="mx-1">修改</a>
                                    <a class="btn btn-danger " href="deleteGuide.php?id=<?=$value["id"]?>"
                                        onclick="return confirmAct();"><i class="fa fa-trash"><span class="mx-1"></i>刪除
                                    </a>
                                </span>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
