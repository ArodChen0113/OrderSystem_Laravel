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
                            <a href="openMealV">今日開餐</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <body>
    <div class="site-content-contain">
        <div id="content" class="site-content">
            <div class="wrap">
                <div id="primary" class="content-area">
                    <div class="container">
                        <nav class="woocommerce-breadcrumb">
                            <a href="#">Home</a>
                            菜單編輯&刪除
                        </nav>
                    </div>
                    <div class="wrap-main-page-cart tp-content-page tp-page-title-16">
                        <div class="tp-content-cart-items">
                            <div class="tp-table-cart">
                                <div class="container">
                                    <div class="actions">
                                        <div class="">
                                            <form action="orderPay_update.php" method="post" enctype="multipart/form-data">
                                                <table border="1">
                                                    <tr>
                                                        <td colspan="5" align="center" bgcolor="#FFABAB"><?php echo '餐廳名稱：'.$restName; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" width="300px" bgcolor="#FFE1AB">菜單</td>
                                                        <td align="center" width="300px" bgcolor="#ABFFAB">金額</td>
                                                        <td align="center" width="300px" bgcolor="#00FFFF">圖片</td>
                                                        <td align="center" width="300px" bgcolor="#DBABFF">修改</td>
                                                        <td align="center" width="300px" bgcolor="#FFABAB">刪除</td>
                                                    </tr>

                                                    <?php
                                                    $num=count($restData);
                                                    for($k=0;$k<=$num-1;$k++) {
                                                        $value=$restData[$k];
                                                        ?>
                                                        <tr>
                                                            <td align="center"><?php echo $value->kind; ?></td>
                                                            <td align="center"><?php echo $value->unit_price; ?></td>
                                                            <td align="center"><img src="/userUpload/<?php echo $value->menu_picture; ?>" width="150" height="150"></td>
                                                            <td align="center"><a href="menuUpdateV?num=<?php echo $value->m_num; ?>&restName=<?php echo $restName; ?>"><img src="icon/pencil.jpeg" width="30" height="30"></a></td>
                                                            <td align="center"><a href="action_meDel?action=delete&restName=<?php echo $restName; ?>&num=<?php echo $value->m_num; ?>"><img src="icon/x.jpeg" width="30" height="30"></a></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </table>
                                                <br>
                                                <input type="button" value="返回餐廳管理" onclick="self.location.href='restChooseV'"/>
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
    <script src="assets/js/menu.js"></script> <!--RWD縮小選單列-->
    </body>
</html>