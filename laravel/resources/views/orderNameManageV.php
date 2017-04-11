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
                                                if($orderData==NULL){
                                                    ?>
                                                    <font color="red" size="3">今日尚無訂餐！</font>
                                                    <?php
                                                }else{
                                                ?>
                                                <tr>
                                                    <td colspan="2" align="center" bgcolor="#FFABAB">
                                                        今日訂餐：<?php echo $open_restName; ?></td>
                                                    <td colspan="1" align="center" bgcolor="#FFE1AB">
                                                        餐廳電話：<?php echo $open_restTel; ?></td>
                                                </tr>
                                                <tr>
                                                    <td align="center" width="300px" bgcolor="#FFE1AB">訂購人</td>
                                                    <td align="center" width="300px" bgcolor="#DBABFF">訂購金額</td>
                                                    <td align="center" width="300px" bgcolor="#FFABAB">繳費</td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $num = count($orderData);
                                                for ($k = 0; $k <= $num - 1; $k++) {
                                                    $value = $orderData[$k];
                                                    ?>
                                                    <tr>
                                                        <?php
                                                        echo "<td align=\"center\"><b>" . $value->name . "</<b></td>";
                                                        echo "<td align=\"center\"><b>" . $value->price . "</<b></td>";
                                                        ?>
                                                        <td align="center">
                                                            <?php
                                                            if ($value->pay == 0) {
                                                                ?>
                                                                <font color="#FF0000">尚未繳費</font>
                                                                <a href="orderNameManageV?action=pay&payName=<?php echo $value->name; ?>"><img
                                                                            src="icon/th.jpeg" width="30"
                                                                            height="30"></a>
                                                            <?php } else if ($value->pay == 1) {
                                                            ?>
                                                            已繳費
                                                            <?php
                                                            ?>
                                                        </td>
                                                    <?php
                                                    }
                                                    ?>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                <tr>
                                                    <td align="center">訂餐人數</td>
                                                    <td align="center" colspan="2"><font
                                                                color="#0000cd"><?php echo count($orderData); ?></font>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">餐點數量</td>
                                                    <td align="center" colspan="2"><font
                                                                color="#0000cd"><?php echo $sumOrderCount; ?></font>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">金額總計</td>
                                                    <td align="center" colspan="2"><font
                                                                color="red"><?php echo $totalPrice; ?></font>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                            <div class="actions">
                                                <div class="text-left tp-btn-con-shopping">
                                                    <a href="orderMenuManageV" class="tp-btn">菜單排序總覽</a>
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