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

    <div class="site-content-contain">
        <div id="content" class="site-content">
            <div class="wrap">
                <div id="primary" class="content-area">
                    <div class="container">
                        <nav class="woocommerce-breadcrumb">
                            <a href="#">Home</a>
                            今日開餐
                        </nav>
                    </div>
                    <div class="wrap-main-page-cart tp-content-page tp-page-title-16">
                        <div class="tp-content-cart-items">
                            <div class="tp-table-cart">
                                <div class="container">
                                    <div class="actions">
                                        <div class="text-left tp-btn-con-shopping">
                                            <form name="rest_management" action="action_openMeal" method="post" enctype="multipart/form-data">
                                                <table border="1">
                                                    <tr>
                                                        <td colspan="3" align="center" bgcolor="#FFABAB">餐廳管理</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"></td>
                                                        <td align="center" bgcolor="#DBABFF">餐廳名稱</td>
                                                    </tr>
                                                    <tr>
                                                        <td>請選擇今日開餐：</td>
                                                        <td><select style="width:240px" name="restChoose" onchange="window.location='openMealV?restName='+this.value">

                                                                <option value=""><?php
                                                                    if($restName==NULL){
                                                                        echo "請選擇";
                                                                    }else{
                                                                        echo $restName;}?></option>
                                                                <?php
                                                                $num=count($openMeal);
                                                                for ($k=0;$k<=$num-1;$k++){
                                                                    $value=$openMeal[$k];
                                                                    ?>
                                                                    <option value="<?php echo $value->rest_name; ?>"><?php echo $value->rest_name; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select></td>
                                                    </tr>
                                                </table>
                                                <table border="1">
                                                    <?php if($restName!=NULL){?>
                                                        <tr>
                                                            <td align="center" bgcolor="#ABFFFF">所選餐廳: <?php echo $restName; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><img src="/userUpload/<?php echo $restPic; ?>" width="800" height="600"></td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                                <br>
                                                <input type="hidden" name="action" value="update">
                                                <input type="hidden" name="restName" value="<?php echo $restName; ?>">
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                目前開餐餐廳&nbsp:&nbsp<font color="#FF0000"><?php echo $openRestName;?></font>
                                                <br>
                                                選擇好餐廳，按下<font color="#FF0000">開餐</font>按鈕 >>>
                                                <input type="submit" value="確定開餐">
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