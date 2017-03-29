<?php
include ("menu_js.js");
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>訂購單頁面</title>
</head>
<body>
<form action="controller/order_controller.php" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td colspan="4" align="center" bgcolor="#ABFFFF">下單區</td>
        </tr>
        <tr>
            <td align="center" width="50px" bgcolor="#FFE1AB">訂購項目</td>
            <td align="center" width="100px" bgcolor="#ABFFAB">單價</td>
            <td align="center" width="100px" bgcolor="#DBABFF">圖片</td>
            <td align="center" width="30px" bgcolor="#FFABAB">訂購人</td>
        </tr>
        <tr>  <!--選單一-->
            <td><select style="width:240px" name="kind1" onchange="window.location='1?select1='+this.value">

                    <?php
                    $num=count($rest_kind);
                    for ($k=0;$k<=$num-1;$k++) {
                        $v = $rest_kind[$k];
                        ?>
                        <option value="<?php echo $v->kind; ?>"><?php echo $v->kind; ?></option>
                        <?php
                    }
                    ?>
                </select></td>
            <td width="10%" align="center"></td>
            <td align="center"></td>
            <td><input type="text" name="orderName" value="請填入訂購者姓名" onfocus="cleartext(this)" onblur="resettext(this)"></td>
        </tr>


        <tr>
            <td align="center" bgcolor="#FFA1A1">總計</td>
            <td colspan="2" align="center"><?php echo 0 ; ?></td>
        </tr>
    </table>
    <br>
    <input type="submit" value="送出訂單">
    <br>
    <a href="restMenuInsertV">新增菜單</a>
    <a href="restChooseV">餐廳管理</a>
    <a href="restKindManageV">餐廳分類管理</a>
    <br>
    <a href="/">下單區</a>
    <a href="purchaseManageV">下單總覽</a>
    <br>
    <a href="orderManageV">訂單總覽</a>

</form>
<table border="1">
    <tr>
        <td align="center" bgcolor="#FFD4D4">今日開餐: <?php echo $restname; ?></td>
    </tr>
    <tr>
        <td><img src="/userUpload/<?php echo $restpic; ?>" width="800" height="600"></td>
    </tr>
</table>
</body>
</html>