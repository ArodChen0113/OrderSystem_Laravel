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
<body class="woocommerce woocommerce-page">
<div class="wrap-main wrap-main-01">
    <header class="header">
        <div class="topbar">
            <div class="container">
                <div class="topbar__right">
                    <div class="account">
                        <i class="fa fa-smile-o"></i>
                        <ul class="tp-ul-no-padding tp-li-list-style">
                            <li><font color="red">尚無開餐！</font></li>
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
                            <ul class="sub-menu">
                                <li class="menu-item-has-children">
                                    <a href="purchaseHotOrderV">我的訂餐</a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="purchaseHistoryV">歷史訂餐</a>
                                </li>
                            </ul>
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
                    <h3 class="title-homepage-center">
                            <strong><font color="red">目前尚未有任何開餐！</font></strong>
                    </h3>
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
</body>
</html>