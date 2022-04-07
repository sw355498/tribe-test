<div class="my-2">
                <a href="guide-list.php" class=" text-secondary text-decoration-none h4 text py-2">
                    Guide List
                </a>
            </div>
            <div class="d-flex justify-content-between py-2">
                <div class="">共有 <span class="text-info h5"><?=$total?></span>位使用者<br>本頁顯示<span class="text-info h5"> <?=$amount?></span> 筆資料</div>
                    <div>
                        <form action="guide-search.php" method="get" class="d-flex">
                            <input type="text" class="form-control" name="search" placeholder="關鍵字搜尋"> 
                            <button class="btn btn-outline-info text-nowrap"><i class="fas fa-search"></i><span class="mx-1">搜尋</button>
                        </form>
                    </div>
                </div>
                <div class="pb-2 d-flex justify-content-end">
                    <a href="create-guide-member.php" class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal" ><i class="fas fa-user-plus"></i><span class="mx-1">新增使用者</a>
                </div>
        