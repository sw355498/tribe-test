<nav aria-label="Page navigation example  " class="">
                <ul class="pagination">
                    <!-- 關鍵字篩選分頁 -->
                    <?php  if(isset($_GET["search"])){?>
                      <?php for($i=1; $i<=$pages ; $i++){ ?>
                        <li class="page-item <?php if($i==$p)echo "active";?>">
                        <a class="page-link" 
                        href="product_search123.php?
                          search=<?=$_GET["search"]?>&
                          p=<?=$i?>
                          "><?=$i?></a></li>
                      <?php } ?>
                    <!-- 商品狀態篩選分頁 -->
                    <?php }else if(isset($_GET["status"])){ ?>
                        <?php for($i=1; $i<=$pages ; $i++){ ?>
                      <li class="page-item <?php if($i==$p)echo "active";?>">
                      <a class="page-link" 
                      href="../product_search123.php?
                        status=<?=$_GET["status"]?>&
                        p=<?=$i?>
                        "><?=$i?></a></li>
                      <?php } ?>
                    <!-- 編碼篩選分頁 -->
                    <?php }else if(isset($_GET["s_id"])){ ?>
                    <?php for($i=1; $i<=$pages ; $i++){ ?>
                      <li class="page-item <?php if($i==$p)echo "active";?>">
                      <a class="page-link" 
                      href="product_search123.php?
                        s_id=<?=$_GET["s_id"]?>&
                        p=<?=$i?>
                        "><?=$i?></a></li>
                      <?php } ?>
                    <!-- 日期篩選分頁 -->
                    <?php } else if(isset($_GET["start"]) && isset($_GET["end"])){?>                    
                    <?php for($i=1; $i<=$pages ; $i++){ ?>
                      <li class="page-item <?php if($i==$p)echo "active";?>">
                      <a class="page-link" 
                      href="product_search123.php?
                        start=<?=$_GET["start"]?>&
                        end=<?=$_GET["end"]?>&
                        p=<?=$i?>
                        "><?=$i?></a></li>
                      <?php } ?>
                    <!-- 價格篩選 -->
                    <?php } else if(isset($_GET["price_start"]) && isset($_GET["price_end"])){?>
                      <?php for($i=1; $i<=$pages ; $i++){ ?>
                      <li class="page-item <?php if($i==$p)echo "active";?>">
                      <a class="page-link" 
                      href="product_search123.php?
                        price_start=<?=$_GET["price_start"]?>&
                        price_end=<?=$_GET["price_end"]?>&
                        p=<?=$i?>
                        "><?=$i?></a></li>
                      <?php } ?>
                    <?php }else{ ?>
                    <?php for($i=1; $i<=$pages ; $i++){ ?>
                      <li class="page-item <?php if($i==$p)echo "active";?>">
                      <a class="page-link" 
                      href="product_search123.php?
                        p=<?=$i?>
                        "><?=$i?></a></li>
                      <?php } ?>
                    <?php } ?>                   
                </ul>
        </nav>    