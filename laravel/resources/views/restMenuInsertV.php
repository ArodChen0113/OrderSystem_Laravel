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
                            新增餐廳&菜單
                        </nav>
                    </div>
                    <div class="tp-content-page tp-page-title-16">
                        <div class="tp-content-checkout-items">
                            <div class="container">
                                <div class="row">
                                    <div class="tp-checkout-form tp-form-site">
                                        <form action="action_rmInt" method="post" class="checkout woocommerce-checkout" enctype="multipart/form-data">
                                            <div class="col2-set">
                                                <div class="col-1 col-md-6 col-sm-6 col-xs-12">

                                                    <div class="woocommerce-billing-fields">
                                                        <h3>餐廳新增</h3>
                                                        <div class="form-row">
                                                            <label >餐廳名稱 <abbr class="required" title="required">*</abbr></label>
                                                            <input type="text" name="restName" placeholder="請輸入餐廳名稱">
                                                        </div>
                                                        <div class="form-row">
                                                            <label>餐廳電話 <abbr class="required" title="required">*</abbr></label>
                                                            <input type="text" name="restTel" placeholder="請輸入餐廳電話">
                                                        </div>
                                                        <div class="form-row">
                                                            <label>餐廳分類 <abbr class="required" title="required">*</abbr></label>
                                                            <select name="restKind" >
                                                                <option value="">請選擇餐廳分類</option>
                                                                <?php
                                                                foreach ($restKind as $value){ ?>　
                                                                    <option value="<?php echo $value->rest_kind; ?>"><?php echo $value->rest_kind; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-row">
                                                            <label>餐廳圖片 <abbr class="required" title="required">*</abbr></label>
                                                            <input type="file" name="rest_picture" size="30">
                                                        </div>
                                                    </div>
                                                </div><!-- end col 1 -->
                                                <div class="col-2 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="woocommerce-billing-fields">
                                                    <h3>菜單新增</h3>
                                                    </div>
                                                    <div class="woocommerce-checkout-review-order">
                                                        <div id="payment" class="tp-radio-custom woocommerce-checkout-payment">
                                                            <table border="1">
                                                                <tr>
                                                                    <td colspan="4" align="center" bgcolor="#A3A3FF">菜單</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" bgcolor="#FFB5B5" width="20%">菜單名稱</td>
                                                                    <td align="center" bgcolor="#FFE5B5" width="30%">菜單類別</td>
                                                                    <td align="center" bgcolor="#ABFFAB" width="15%">項目單價</td>
                                                                    <td align="center" bgcolor="#DBABFF">上傳料理圖片</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="kind[]" placeholder="請輸入菜單名稱"></td>
                                                                    <td><select name="m_kind[]">
                                                                              <option value="">請選擇菜單類別</option>
                                                                            　<option value="飯">飯</option>
                                                                            　<option value="麵">麵</option>
                                                                            　<option value="湯">湯</option>
                                                                            　<option value="小菜">小菜</option>
                                                                        </select></td>
                                                                    <td><input type="text" name="price[]" placeholder="單價"></td>
                                                                    <td><input type="file" name="menu_picture[]" size="30"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="kind[]"></td>
                                                                    <td><select name="m_kind[]">
                                                                             <option value="">請選擇菜單類別</option>
                                                                            　<option value="飯">飯</option>
                                                                            　<option value="麵">麵</option>
                                                                            　<option value="湯">湯</option>
                                                                            　<option value="小菜">小菜</option>
                                                                        </select></td>
                                                                    <td><input type="text" name="price[]"></td>
                                                                    <td><input type="file" name="menu_picture[]" size="30"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="kind[]"></td>
                                                                    <td><select name="m_kind[]">
                                                                            <option value="">請選擇菜單類別</option>
                                                                            　<option value="飯">飯</option>
                                                                            　<option value="麵">麵</option>
                                                                            　<option value="湯">湯</option>
                                                                            　<option value="小菜">小菜</option>
                                                                        </select></td>
                                                                    <td><input type="text" name="price[]"></td>
                                                                    <td><input type="file" name="menu_picture[]" size="30"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="kind[]"></td>
                                                                    <td><select name="m_kind[]">
                                                                            <option value="">請選擇菜單類別</option>
                                                                            　<option value="飯">飯</option>
                                                                            　<option value="麵">麵</option>
                                                                            　<option value="湯">湯</option>
                                                                            　<option value="小菜">小菜</option>
                                                                        </select></td>
                                                                    <td><input type="text" name="price[]"></td>
                                                                    <td><input type="file" name="menu_picture[]" size="30"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="kind[]"></td>
                                                                    <td><select name="m_kind[]">
                                                                            <option value="">請選擇菜單類別</option>
                                                                            　<option value="飯">飯</option>
                                                                            　<option value="麵">麵</option>
                                                                            　<option value="湯">湯</option>
                                                                            　<option value="小菜">小菜</option>
                                                                        </select></td>
                                                                    <td><input type="text" name="price[]"></td>
                                                                    <td><input type="file" name="menu_picture[]" size="30"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="kind[]"></td>
                                                                    <td><select name="m_kind[]">
                                                                            <option value="">請選擇菜單類別</option>
                                                                            　<option value="飯">飯</option>
                                                                            　<option value="麵">麵</option>
                                                                            　<option value="湯">湯</option>
                                                                            　<option value="小菜">小菜</option>
                                                                        </select></td>
                                                                    <td><input type="text" name="price[]"></td>
                                                                    <td><input type="file" name="menu_picture[]" size="30"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="kind[]"></td>
                                                                    <td><select name="m_kind[]">
                                                                            <option value="">請選擇菜單類別</option>
                                                                            　<option value="飯">飯</option>
                                                                            　<option value="麵">麵</option>
                                                                            　<option value="湯">湯</option>
                                                                            　<option value="小菜">小菜</option>
                                                                        </select></td>
                                                                    <td><input type="text" name="price[]"></td>
                                                                    <td><input type="file" name="menu_picture[]" size="30"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="kind[]"></td>
                                                                    <td><select name="m_kind[]">
                                                                            <option value="">請選擇菜單類別</option>
                                                                            　<option value="飯">飯</option>
                                                                            　<option value="麵">麵</option>
                                                                            　<option value="湯">湯</option>
                                                                            　<option value="小菜">小菜</option>
                                                                        </select></td>
                                                                    <td><input type="text" name="price[]"></td>
                                                                    <td><input type="file" name="menu_picture[]" size="30"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="kind[]"></td>
                                                                    <td><select name="m_kind[]">
                                                                            <option value="">請選擇菜單類別</option>
                                                                            　<option value="飯">飯</option>
                                                                            　<option value="麵">麵</option>
                                                                            　<option value="湯">湯</option>
                                                                            　<option value="小菜">小菜</option>
                                                                        </select></td>
                                                                    <td><input type="text" name="price[]"></td>
                                                                    <td><input type="file" name="menu_picture[]" size="30"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="kind[]"></td>
                                                                    <td><select name="m_kind[]">
                                                                            <option value="">請選擇菜單類別</option>
                                                                            　<option value="飯">飯</option>
                                                                            　<option value="麵">麵</option>
                                                                            　<option value="湯">湯</option>
                                                                            　<option value="小菜">小菜</option>
                                                                        </select></td>
                                                                    <td><input type="text" name="price[]"></td>
                                                                    <td><input type="file" name="menu_picture[]" size="30"></td>
                                                                </tr>
                                                            </table>
                                                            <br>
                                                            <input type="hidden" name="action" value="insert">
                                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                            <div class="form-row place-order">
                                                                <input type="submit"  class="button" value="確認新增 ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end col 2 -->
                                            </div>
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
<?php if($result!=NULL){?>
<script>
    function define() {
        alert("<?php echo $result;?>");
    }
</script>
<?php
}
?>
</body>
</html>