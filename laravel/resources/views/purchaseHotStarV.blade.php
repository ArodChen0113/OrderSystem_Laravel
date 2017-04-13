<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>訂餐系統</title>
    <link rel="stylesheet" href="assets/css/vendors/bootstrap.min.css"> <!--logout-->
    <link rel="stylesheet" href="assets/css/vendors/font-awesome.min.css"> <!--選單-->
    <link rel="stylesheet" href="assets/css/vendors/woo/woocommerce.css"> <!--文字-->
    <link rel="stylesheet" href="assets/css/common/style.css"> <!--版面-->
    <link href="assets/css/jsStar/jstarbox.css" rel="stylesheet"></link><!--評價星星效果-->
</head>
<body class="woocommerce woocommerce-page" onload="defineInt()">
<div class="wrap-main wrap-main-01">
    <header class="header">
        <div class="topbar">
            <div class="container">
                <div class="topbar__right">
                    <div class="account">
                        <i class="fa fa-smile-o"></i>
                        <ul class="tp-ul-no-padding tp-li-list-style">
                            <li><font color="red"><?php echo $hours; ?>點<?php echo $minutes;?>分收單 (<?php echo $timer;?>)</font></li>
                            <li> / </li>
                            <li><a href="logout">Sign out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- container -->
        </div>
        <!-- topbar -->
        <div class="navbar">
            <div class="container">
                <div class="header-mobile">
                    <div class="open-menu-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <nav class="main-nav">
                    <ul class="main-menu">
                        <li class="menu-item-has-children tp-activated">
                            <a href="/">訂購系統</a>
                            <ul class="sub-menu">
                                <li class="menu-item-has-children">
                                    <a href="purchaseHotOrderV">熱門人氣</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="purchaseHotStarV">最高評價</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children tp-activated">
                            <a href="purchaseManageV">我的訂餐</a>
                        </li>
                        <li class="menu-item-has-children tp-activated">
                            <a href="">訂餐總覽</a>
                            <ul class="sub-menu">
                                <li class="menu-item-has-children">
                                    <a href="orderNameManageV">以訂購者排序</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="orderMenuManageV">以菜單名排序</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children tp-activated">
                            <a href="">餐廳管理</a>
                            <ul class="sub-menu">
                                <li class="menu-item-has-children">
                                    <a href="restMenuInsertV">新增餐廳&菜單</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="restChooseV">編輯餐廳&菜單</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="restKindManageV">餐廳分類管理</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children tp-activated">
                            <a href="">今日開餐</a>
                            <ul class="sub-menu">
                                <li class="menu-item-has-children">
                                    <a href="openMealV">今日開餐</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="hotRestEvaluationV">餐廳評價</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="site-content-contain">
        <div id="content" class="site-content">
            <div class="wrap">
                <div id="primary" class="content-area">
                <br>
                    <br>
                    <h3 class="title-homepage-center"><?php echo $restName;?></h3>
                    <div class="container tab-product-01">
                        <div class="tab-content shortcode-product-slider-01">
                            <!--全部-->
                            <div role="tabpanel" class="tab-pane active" id="all">
                                <div class="row">
                                    <?php
                                    $numAll=count($restMenuAll);
                                    for($i=0;$i<=$numAll-1;$i++){
                                        $value=$restMenuAll[$i];
                                    ?>
                                    <div class="col-md-3 col-xs-6">
                                        <div class="product type-product has-post-thumbnail">
                                            <div class="product-image">
                                                    <img src="/userUpload/<?php echo $value->menu_picture; ?>" alt="shop item">
                                                <div class="product-action">
                                                    <a href="purchaseHotOrderV" class="tp-btn-wishlist"><i class="fa fa-heart-o"></i></a>
                                                    <a href="purchaseHotStarV?pic=<?php echo $value->menu_picture; ?>#product-quickview" class="btn-quickview"><i class="fa fa-search-plus"></i></a>
                                                    <a href="purchaseManageV" class="tp-btn-compare"><i class="fa fa-list-ul"></i></a>
                                                    <div><font color="#FFFFFF">1 Hours 23 Minutes left</font></div>
                                                </div>
                                            </div>
                                            <span class="onnew">HOT</span>
                                            <h3><a href="product-detail.html"><?php echo $value->kind;?>
                                                <font color="red">評價：<?php $star=$value->m_star; echo round($star*5,1);?>星</font>
                                                </a></h3>
                                            <div class="product-info">
                                                <div class="price">
                                                    <span class="woocommerce-Price-amount amount">NT.&nbsp $<?php echo $value->unit_price;?>&nbsp</span>
                                                </div>
                                                <div class="starBoxAll<?php echo $i;?>"><?php $starAll[$i]=$value->m_star; ?></div>
                                            </div>
                                            <a href="/?action=insert&num=<?php echo $value->m_num;?>" class="button add_to_cart_button">我要訂購</a>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="explore-more"><a class="tp-button" href="purchaseManageV">我 的 訂 餐</a></div>
                            </div>
                        </div>
                        <div class="product-quickview">
                            <div class="container">
                                <div class="btn-close">
                                    <i class="fa fa-times"></i>
                                </div>
                                <div class="content-product-quickview">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="image-product-detail images">
                                                <img src="/userUpload/{{ Input::get('pic') }}" alt="product detail">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/vendors/jquery.min.js"></script> <!--點觸淡出效果-->
<script src="assets/js/vendors/bootstrap.min.js"></script> <!--點觸淡出效果-->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script> <!--評價星星效果-->
<script src="assets/jstarbox.js"></script> <!--評價星星效果-->
<script src="assets/js/vendors/swiper.min.js"></script> <!--訂購圖片放大-->
<script src="assets/js/global.js"></script> <!--訂購圖片放大-->
<script src="assets/js/menu.js"></script> <!--RWD縮小選單列-->
<?php if($orderKind!=NULL){?>
<script>
    function defineInt() {
        alert("<?php echo $orderKind;?> 已訂購！");
    }
</script>
<?php
}
for($i=0;$i<=$numAll-1;$i++){
    ?>
    <script type="text/javascript"> //評價星星效果
        $('.starBoxAll<?php echo $i;?>').starbox({
            average: <?php echo $starAll[$i]; ?>,//預設一開始顯示幾顆星星
            stars: 5,//設定有幾顆星星可以選擇
            buttons: 5,//設定星星可以切割成多少區塊可以選擇
            changeable: false,//只能設定一次分數
            autoUpdateAverage: false, //是否可更改分數
            ghosting: false
        });
    </script>
    <?php
}
?>
</body>
</html>