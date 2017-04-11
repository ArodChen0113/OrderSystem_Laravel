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
    <body>
    <div class="site-content-contain">
        <div id="content" class="site-content">
            <div class="wrap">
                <div id="primary" class="content-area">
                    <div class="container">
                        <nav class="woocommerce-breadcrumb">
                            <a href="#">Home</a>
                            餐廳資料編輯修改
                        </nav>
                    </div>
                    <div class="wrap-main-page-cart tp-content-page tp-page-title-16">
                        <div class="tp-content-cart-items">
                            <div class="tp-table-cart">
                                <div class="container">
                                    <div class="actions">
                                        <div class="">
                                            <form name="rest_open" action="restManageV" method="post" enctype="multipart/form-data">
                                                <table border="1">
                                                    <tr>
                                                        <td colspan="3" align="center" bgcolor="#FFABAB">餐廳管理</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" bgcolor="#FFE1AB">餐廳名稱</td>
                                                        <td align="center" bgcolor="#ABFFAB">分類</td>
                                                        <td align="center" bgcolor="#DBABFF">電話</td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" name="restName" value="<?php echo $restName;?>"></td>
                                                        <td><input type="text" name="restKind" value="<?php echo $restKind;?>"></td>
                                                        <td><input type="text" name="restTel" value="<?php echo $restTel;?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" align="center" bgcolor="#ABFFFF">菜單</td>
                                                        <td align="center" bgcolor="#DBABFF">上傳欲修改菜單圖片</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><img src="/userUpload/<?php echo $restPic; ?>" width="800" height="600"></td>
                                                        <td><input type="file" name="rest_picture" size="30"></td>
                                                    </tr>
                                                </table>
                                                <br>
                                                <input type="hidden" name="num" value="<?php echo $restNum; ?>">
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                <input type="hidden" name="action" value="update">
                                                如欲<font color="#FF0000">修改</font>餐廳資料，按下修改按鈕 >>>
                                                <input type="submit" value="確定修改">
                                                如欲瀏覽<font color="#FF0000">菜單</font>資料，按下瀏覽按鈕 >>>
                                                <input type="button" value="菜單瀏覽" onclick="self.location.href='menuV?restName=<?php echo $restName; ?>'"/>
                                                如欲<font color="#FF0000">刪除</font>這間餐廳，按下刪除按鈕 >>>
                                                <a href="restManageV?action=delete&restname=<?php echo $restName; ?>"><img src="icon/x.jpeg" width="30" height="30"></a>
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