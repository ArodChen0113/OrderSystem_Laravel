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
<body class="woocommerce woocommerce-page" onload="define()">
<div class="wrap-main">

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
                    <div class="container">
                        <nav class="woocommerce-breadcrumb">
                            <a href="#">Home</a>
                            我的訂餐
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
                                                <tr>
                                                    <th class="product-name">菜色圖片</th>
                                                    <th class="product-name">菜色名稱</th>
                                                    <th class="product-price">單價</th>
                                                    <th class="product-quantity">數量</th>
                                                    <th class="product-remove">刪除</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if($orderData!=NULL){
                                                $num=count($orderData);
                                                for($k=0;$k<=$num-1;$k++) {
                                                $value=$orderData[$k];
                                                ?>
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        <img src="/userUpload/<?php echo $value->menu_picture; ?>" width="150" height="150"></td>
                                                    </td>
                                                    <td class="product-name">
                                                    <?php echo $value->kind;?>
                                                    </td>
                                                    <td class="product-price" data-title="Price">
                                                        <span class="amount">NT.&nbsp $<?php echo $value->unit_price;?>&nbsp</span>
                                                    </td>
                                                    <td class="product-quantity" data-title="Qty">
                                                        <?php echo $value->qty;?>
                                                    </td>
                                                    <td class="product-remove" data-title="Remove"><a href="purchaseManageV?action=delete&num=<?php echo $value->num; ?>" class="remove">×</a></td>
                                                </tr>
                                                    <?php
                                                }
                                                }else{
                                                    ?>
                                                    <tr>
                                                        <td colspan="5" align="center">今日尚無訂餐</td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                            <div class="actions">
                                                <div class="text-left tp-btn-con-shopping">
                                                    <?php if($error!=NULL) {?>
                                                        <strong><font color="red">當日已評價！</font></strong>
                                                    <?php
                                                    }else{
                                                        ?>
                                                    <a href="userEvaluationV" class="tp-btn">我要評價</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </form>
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
                                                    <p>
                                                        <span>TOTAL</span>
                                                        $<?php echo $sumPrice;?>
                                                    </p>
                                                    <a href="/">繼續選購 <i class="fa fa-angle-double-right"></i></a>
                                                </div>
                                            </div><!-- box add code coupon and link checkout -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="related-product">
                                    <h3 class="title-related">熱門菜色</h3>

                                    <div class="swiper-container product-related tp-slider-tpl">
                                        <div class="swiper-wrapper">
                                            <?php
                                            for($i=0;$i<=3;$i++){
                                            $value=$hotOrder[$i];
                                            ?>
                                            <div class="col-md-3 col-xs-6">
                                                <div class="product type-product has-post-thumbnail">
                                                    <div class="product-image">
                                                        <a href="#">
                                                            <img src="/userUpload/<?php echo $value->menu_picture;?>" alt="shop item">
                                                        </a>
                                                        <div class="product-action">
                                                            <a href="purchaseHotOrderV" class="tp-btn-wishlist"><i class="fa fa-heart-o"></i></a>
                                                            <a href="purchaseManageV?pic=<?php echo $value->menu_picture; ?>#product-quickview" class="tp-btn-quickview"><i class="fa fa-search-plus"></i></a>
                                                            <a href="purchaseManageV" class="tp-btn-compare"><i class="fa fa-list-ul"></i></a>
                                                            <div><font color="#FFFFFF"><?php echo $timer;?></font></div>
                                                        </div>
                                                    </div>
                                                    <span class="onnew">Hot</span>
                                                    <h3><a href="#"><?php echo $value->kind;?></a></h3>
                                                    <div class="price">NT.&nbsp $<?php echo $value->unit_price;?>&nbsp</div>
                                                    <div class="product-info">
                                                        <div class="starBoxHot<?php echo $i;?>"><?php $starHot[$i]=$value->m_star; ?></div>
                                                        <a href="purchaseManageV?action=insert&num=<?php echo $value->m_num;?>" class="button add_to_cart_button">我要訂購</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
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
        </div>
    </div>

</div>
<script src="assets/js/vendors/jquery.min.js"></script> <!--點觸淡出效果-->
<script src="assets/js/vendors/bootstrap.min.js"></script> <!--點觸淡出效果-->
<script src="assets/js/menu.js"></script> <!--RWD縮小選單列-->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script> <!--評價星星效果-->
<script src="assets/jstarbox.js"></script> <!--評價星星效果-->
<?php if($action=='insert'){?>
<script>
    function define() {
        alert("<?php echo $orderKind;?> 已訂購！");
    }
</script>
<?php
}
if($action=='delete'){?>
<script>
    function define() {
        alert("<?php echo $orderKind;?> 已刪除！");
    }
</script>
<?php
}
for($i=0;$i<=3;$i++){
    ?>
    <script type="text/javascript"> //評價星星效果
        $('.starBoxHot<?php echo $i;?>').starbox({
            average: <?php echo $starHot[$i]; ?>,//預設一開始顯示幾顆星星
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