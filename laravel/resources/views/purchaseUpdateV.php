<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>訂購單修改頁面</title>
</head>
<body>
<form action="order_index.php" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td colspan="4" align="center" bgcolor="#ABFFFF">下單瀏覽＆修改</td>
        </tr>
        <tr>
            <td colspan="4" align="center" bgcolor="#FFABAB">訂購者：<?php echo $orderName; ?></td>
        </tr>
        <tr>
            <td align="center" width="300px" bgcolor="#FFE1AB">菜單</td>
            <td align="center" width="300px" bgcolor="#ABFFAB">單價</td>
            <td align="center" width="100px" bgcolor="#59FFFF">圖片</td>
            <td align="center" width="300px" bgcolor="#DBABFF">刪除</td>
        </tr>
        <?php
        $num=count($order);
        for($k=0;$k<=$num-1;$k++) {
            $value=$order[$k];
            ?>
            <tr>
                <td align="center"><?php echo $value->kind; ?></td>
                <td align="center"><?php echo $value->unit_price; ?></td>
                <td align="center"><img src="/userUpload/<?php echo $value->menu_picture; ?>" width="150" height="150"></td>
                    <td align="center"><a
                                href="action_pcDel?action=delete&num=<?php echo $value->num; ?>"><img
                                    src="icon/x.jpeg" width="30" height="30"></a></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="1" align="center" bgcolor="#FFABAB">總價</td>
            <td colspan="3" align="center" ><font color="blue"><?php echo $sumPrice;?></font></td>
        </tr>
    </table>
    <br>
    <input type="submit" value="訂餐加購">
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