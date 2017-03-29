<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>菜單修改頁面</title>
</head>
<body>
<form action="action_meUp" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td colspan="4" align="center" bgcolor="#ABFFFF">菜單總覽</td>
        </tr>
        <tr>
            <td align="center" width="300px" bgcolor="#FFE1AB">菜單</td>
            <td align="center" width="300px" bgcolor="#ABFFAB">金額</td>
            <td align="center" width="300px" bgcolor="#FFABFF">圖片</td>
            <td align="center" width="300px" bgcolor="#FFABAB">如要修改圖片，請重新上傳</td>
        </tr>
        <?php
        $num=count($rest_data);
        for($k=0;$k<=$num-1;$k++) {
            $v=$rest_data[$k];
        ?>
            <tr>
                <td><input type="text" name="kind" value="<?php echo $v->kind; ?>"></td>
                <td><input type="text" name="price" value="<?php echo $v->unit_price; ?>"></td>
                    <td align="center"><img src="/userUpload/<?php echo $v->menu_picture; ?>" width="150"
                                            height="150"></td>
                    <input type="hidden" name="num" value="<?php echo $v->m_num; ?>">
                <td><input type="file" name="menu_picture"></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <br>
    <input type="hidden" name="restName" value="<?php echo $restname;?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="action" value="update">
    <input type="submit" value="確定修改">
    <input type="button" value="返回菜單瀏覽" onclick="self.location.href='menuV?restname=<?php echo $restname; ?>'"/>
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
</body>
</html>

