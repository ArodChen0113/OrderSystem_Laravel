<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>我的訂餐</title>
    <link rel="stylesheet" href="assets/css/vendors/bootstrap.min.css"> <!--logout-->
    <link rel="stylesheet" href="assets/css/vendors/font-awesome.min.css"> <!--選單-->
    <link rel="stylesheet" href="assets/css/vendors/woo/woocommerce.css"> <!--文字-->
    <link rel="stylesheet" href="assets/css/common/style.css"> <!--版面-->
</head>
<body class="woocommerce woocommerce-page">
<div class="wrap-main">

    <header class="header">
        <div class="topbar">
            <div class="container">
                <div class="topbar__right">
                    <div class="account">
                        <i class="fa fa-smile-o"></i>
                        <ul class="tp-ul-no-padding tp-li-list-style">
                            <li><a href="login.html">Sign in</a></li>
                            <li> / </li>
                            <li><a href="register.html">Register</a></li>
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
                    <div class="container">
                        <nav class="woocommerce-breadcrumb">
                            <a href="#">Home</a>
                            訂餐總覽 (以訂購者排序)
                        </nav>
                    </div>
                    <div class="wrap-main-page-cart tp-content-page tp-page-title-16">
                        <div class="tp-content-cart-items">
                            <div class="tp-table-cart">
                                <div class="container">
                                    <div class="tp-content-table-cart">
                                        <form action="#" method="post">
                                            <table class="shop_table cart" >
                                                <thead>
                                                <?php
                                                if($order_menu==NULL){
                                                    ?>
                                                <font color="red" size="3">今日尚無訂餐！</font>
                                                <?php
                                                }else{
                                                ?>
                                                <tr>
                                                    <td align="center" width="300px" bgcolor="#FFE1AB">菜單</td>
                                                    <td align="center" width="300px" bgcolor="#ABFFAB">圖片</td>
                                                    <td align="center" width="300px" bgcolor="#00FFFF">訂購數量</td>
                                                    <td align="center" width="300px" bgcolor="#DBABFF">單價</td>
                                                    <td align="center" width="300px" bgcolor="#FFABAB">訂購人</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $num=count($order_menu);
                                                for($k=0;$k<=$num-1;$k++) {
                                                    $value2=$order_menu[$k];
                                                    ?>
                                                    <tr>
                                                        <?php
                                                        echo "<td align=\"center\"><b>" . $value2->kind . "</<b></td>";
                                                        ?>
                                                        <td align="center"><img src="/userUpload/<?php echo $order_pic[$k] ; ?>" width="150" height="150"></td>
                                                        <?php
                                                        echo "<td align=\"center\"><b>" . $kindCount[$k] . "</<b></td>";
                                                        echo "<td align=\"center\"><b>" . $order_unitPrice[$k] . "</<b></td>";
                                                        ?>
                                                        <td align="center"><b>
                                                                <?php
                                                                foreach ($kindOrderName[$k] as $value3) {
                                                                    echo $value3->name."(".$value3->qty.") ";
                                                                }
                                                                ?>
                                                            </<b></td>
                                                    </tr>
                                                    <?php
                                                }}
                                                ?>
                                                </tbody>
                                            </table>
                                            <div class="actions">
                                                <div class="text-left tp-btn-con-shopping">
                                                    <a href="orderNameManageV" class="tp-btn">訂購者排序總覽</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- table cart -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="assets/js/vendors/jquery.min.js"></script> <!--點觸淡出效果-->
<script src="assets/js/vendors/bootstrap.min.js"></script> <!--點觸淡出效果-->
<script src="assets/js/menu.js"></script> <!--RWD縮小選單列-->
</body>
</html>