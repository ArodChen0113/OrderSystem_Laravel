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
    <link href="assets/css/jsStar/jstarbox.css" rel="stylesheet"></link><!--評價星星效果-->
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
                            <a href="/">Home</a>
                            餐廳評價
                        </nav>
                    </div>
                    <div class="wrap-main-page-cart tp-content-page tp-page-title-16">
                        <div class="tp-content-cart-items">
                            <div class="tp-table-cart">
                                <div class="container">
                                    <div class="tp-content-table-cart">
                                        <form action="action_cInt" method="post">
                                            <table class="shop_table cart" >
                                                <thead>
                                                <tr>
                                                    <th class="product-name">餐廳圖片</th>
                                                    <th class="product-name">餐廳名稱</th>
                                                    <th class="product-name">分數</th>
                                                    <th class="product-price">整體評價</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if($hotRestData!=NULL){
                                                $num=count($hotRestData);
                                                for($i=0;$i<=$num-1;$i++) {
                                                $value=$hotRestData[$i];
                                                ?>
                                                    <td class="product-name">
                                                        <img src="/userUpload/<?php echo $value->rest_picture; ?>" width="150" height="150"></td>
                                                    </td>
                                                    <td class="product-name">
                                                    <?php echo $value->rest_name;?>
                                                    </td>
                                                    <td class="product-name">
                                                        <font color="red"><?php $rStar=$value->r_star; echo round($rStar*5,1) ;?></font>
                                                    </td>
                                                    <td><div class="starBox<?php echo $i;?>"><?php echo $star[$i]=$value->r_star;?></div></td>
                                                    </tr>
                                                    <?php
                                                }
                                                }?>
                                                </tbody>
                                            </table>
                                            <div class="actions">
                                                <div class="text-left tp-btn-con-shopping">
                                                    <a href="openMealV" class="tp-btn">今日開餐</a>
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
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script> <!--評價星星效果-->
<script src="assets/jstarbox.js"></script> <!--評價星星效果-->
<?php
$hotNum=count($hotRestData);
for($i=0;$i<=$hotNum-1;$i++) {
    ?>
    <script type="text/javascript"> //評價星星效果
        $('.starBox<?php echo $i;?>').starbox({
            average: <?php echo $star[$i];?>,//預設一開始顯示幾顆星星
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