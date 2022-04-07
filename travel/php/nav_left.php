<div class="p-0">    

        <div class="side-menu">

                <!-- logot -->
                <div class="logout">
                    <h6 class="text-center px-3 mt-2">Hi&nbsp;,&nbsp;<?= sprintf($_SESSION["user"]["account"]) ?></h6>
                    <a class="btn btn-light btn-md px-4 mx-3 text-nowrap " href="login/logout.php" role="button"> 登出<i class="fas fa-sign-out-alt"></i></a>
                </div>

            <ul class="nav">
                <li>
                    <a class="" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false"
                        aria-controls="collapseExample1">
                        <i class="fa fa-user fa-file"></i>
                        會員管理
                    </a>
                    <div class="collapse" id="collapseExample1">
                        <div class="card card-body m">
                            <ul class="list-unstyled text-center">
                                <li><a href="/travel/member.php">會員列表</a></li>
                            </ul>
                        </div>
                    </div>

                </li>
                <li>
                    <a class="" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false"
                        aria-controls="collapseExample2">
                        <i class="fa fa-user-secret"></i>
                        導遊管理
                    </a>
                    <div class="collapse" id="collapseExample2">
                        <div class="card card-body m">
                            <ul class=" list-unstyled text-center">
                                <li><a href="/travel/guide-list.php">導遊列表</a></li>
                            </ul>
                        </div>
                    </div>
                <li>
                    <a class="" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false"
                        aria-controls="collapseExample3">
                        <i class="fa fa-file-alt"></i>
                        訂單管理
                    </a>
                    <div class="collapse" id="collapseExample3">
                        <div class="card card-body m">
                            <ul class=" list-unstyled text-center">
                                <li><a href="/travel/cruduser-list.php">訂單列表</a></li>
                                <!-- <li><a href="#">新增訂單</a></li> -->
                            </ul>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="" data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false"
                        aria-controls="collapseExample4">
                        <i class="fa fa-blind"></i>
                        行程管理
                    </a>
                    <div class="collapse" id="collapseExample4">
                        <div class="card card-body m">
                            <ul class=" list-unstyled text-center">
                                <li><a href="/travel/product_list.php">行程列表</a></li>
                                <li><a href="/travel/product_add.php">新增行程</a></li>
                                <!-- <li><a href="#">導遊行程申請/核准</a></li> -->
                            </ul>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="" data-toggle="collapse" href="#collapseExample5" role="button" aria-expanded="false"
                        aria-controls="collapseExample5">
                        <i class="fa fa-map-marker-alt"></i>
                        景點管理
                    </a>
                    <div class="collapse" id="collapseExample5">
                        <div class="card card-body m">
                            <ul class=" list-unstyled text-center">
                                <li><a href="/travel/viewpoint-list.php">景點列表</a></li>
                                <li><a href="/travel/viewpoint-create.php">新增景點</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li>
                    <a class="" data-toggle="collapse" href="#collapseExample6" role="button" aria-expanded="false"
                        aria-controls="collapseExample6">
                        <i class="fa fa-user-tie"></i>
                        後台帳號管理
                    </a>
                    <div class="collapse" id="collapseExample6">
                        <div class="card card-body m">
                            <ul class=" list-unstyled text-center">
                                <!-- <li><a href="#">查詢後臺帳號</a></li> -->
                                <li><a href="/travel/login/sign-up.php">新增後臺帳號</a></li>
                                <!-- <li><a href="#">刪除後臺帳號</a></li>
                                <li><a href="#">修改後臺帳號</a></li> -->
                            </ul>
                        </div>
                    </div>
                </li>
                <!-- <li>
                    <a class="" data-toggle="collapse" href="#collapseExample7" role="button" aria-expanded="false"
                        aria-controls="collapseExample7">
                        <i class="fa fa-user fa-file"></i>
                        權限修改
                    </a>
                    <div class="collapse" id="collapseExample6">
                        <div class="card card-body m">
                            <ul class=" list-unstyled text-center">
                                <li><a href="#">員工權限修改</a></li>
                                <li><a href="#">導遊權限修改</a></li>
                            </ul>
                        </div>
                    </div>
                </li> -->
            </ul>
        <!-- <label for="side-menu-switch">
            <i class="fa fa-angle-right"></i>
        </label> -->
    </div>
</div>