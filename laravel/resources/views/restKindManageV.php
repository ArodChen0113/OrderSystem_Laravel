<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>餐廳&菜單新增</title>
    <link rel="stylesheet" href="assets/css/vendors/bootstrap.min.css"> <!--logout-->
    <link rel="stylesheet" href="assets/css/vendors/font-awesome.min.css"> <!--選單-->
    <link rel="stylesheet" href="assets/css/vendors/woo/woocommerce.css"> <!--文字-->
    <link rel="stylesheet" href="assets/css/common/style.css"> <!--版面-->
</head>
<body class="woocommerce woocommerce-page" onload="define()">
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
                    <div class="container">
                        <nav class="woocommerce-breadcrumb">
                            <a href="/">Home</a>
                            餐廳分類管理
                        </nav>
                    </div>
                    <div class="wrap-main-page-cart tp-content-page tp-page-title-16">
                        <div class="tp-content-cart-items">
                            <div class="tp-table-cart">
                                <div class="container">
                                    <div class="actions">
                                        <div class="text-left tp-btn-con-shopping">
                                            <form name="from2" action="restKindManageV" method="get" enctype="multipart/form-data">
                                                <table border="1">
                                                    <tr>
                                                        <td align="center" bgcolor="#FFABAB">新增分類</td>
                                                        <td align="center"><input type="text" name="restKind"></td>
                                                    </tr>
                                                </table>
                                                <br>
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                <input type="hidden" name="action" value="insert">
                                                如欲<font color="#FF0000">新增</font>餐廳分類，按下新增按鈕 >>>
                                                <input type="submit" value="新增分類">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tp-content-table-cart">
                                        <form name="from1" action="restKindManageV" method="get" enctype="multipart/form-data">
                                            <table class="shop_table cart" >
                                                <thead>
                                                <tr>
                                                    <th class="product-name">分類名稱</th>
                                                    <th class="product-remove">刪除</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $num=count($restData);
                                                for($k=0;$k<=$num-1;$k++) {
                                                $value=$restData[$k];
                                                ?>
                                                        <tr class="cart_item">
                                                            <td class="product-name"><input type="text" name="restKind[]" value="<?php echo $value->rest_kind; ?>"></td>
                                                            <input type="hidden" name="num[]" value="<?php echo $value->num ;?>">
                                                            <td class="product-remove" data-title="Remove"><a href="restKindManageV?action=delete&num=<?php echo $value->num ?>" class="remove">×</a></td>
                                                        </tr>
                                                    <?php
                                                }?>
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div><!-- table cart -->
                            <div class="tp-info-add-checkout">
                                <div class="container">
                                    <div class="row">
                                        <div class="tp-form-site">
                                            <div class="col-md-6 col-sm-6 col-xs-12">

                                            </div><!-- end box form shipping -->
                                            <div class="tp-info-coupon-checkout col-md-6 col-sm-6 col-xs-12">

                                                <div class="tp-link-checkout">
                                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                        <input type="hidden" name="action" value="update">
                                                        <span>如欲<font color="#FF0000">修改</font>餐廳分類，按下修改按鈕 >>></span>
                                                    <input type="submit" value="修改分類">
                                                </div>
                                            </div><!-- box add code coupon and link checkout -->
                                            </form>
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
<script src="assets/js/menu.js"></script> <!--RWD縮小選單列-->
<?php if($action=='insert'){?>
    <script>
        function define() {
            alert("餐廳分類 已新增！");
        }
    </script>
    <?php
}
if($action=='delete'){?>
    <script>
        function define() {
            alert("餐廳分類 已刪除！");
        }
    </script>
    <?php
}
if($action=='update'){?>
<script>
    function define() {
        alert("餐廳分類 已修改！");
    }
</script>
<?php
}
?>
</body>
</html>