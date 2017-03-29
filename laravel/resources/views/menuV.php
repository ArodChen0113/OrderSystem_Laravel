<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>菜單瀏覽頁面</title>
</head>
<body>
<form action="orderPay_update.php" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td colspan="5" align="center" bgcolor="#ABFFFF">菜單總覽</td>
        </tr>
        <tr>
            <td colspan="5" align="center" bgcolor="#FFABAB"><?php echo '餐廳名稱：'.$restname; ?></td>
        </tr>
        <tr>
            <td align="center" width="300px" bgcolor="#FFE1AB">菜單</td>
            <td align="center" width="300px" bgcolor="#ABFFAB">金額</td>
            <td align="center" width="300px" bgcolor="#00FFFF">圖片</td>
            <td align="center" width="300px" bgcolor="#DBABFF">修改</td>
            <td align="center" width="300px" bgcolor="#FFABAB">刪除</td>
        </tr>

        <?php
        $num=count($rest_num);
        for($k=0;$k<=$num-1;$k++) {
            $v=$rest_kind[$k];
            $v2=$rest_price[$k];
            $v3=$rest_pic[$k];
            $v4=$rest_num[$k];
            ?>
            <tr>
                <td align="center"><?php echo $v->kind; ?></td>
                <td align="center"><?php echo $v2->unit_price; ?></td>
                <td align="center"><img src="/userUpload/<?php echo $v3->menu_picture; ?>" width="150" height="150"></td>
                <td align="center"><a href="menuUpdateV?num1=<?php echo $v4->m_num; ?>&restname1=<?php echo $restname; ?>"><img src="icon/pencil.jpeg" width="30" height="30"></a></td>
                <td align="center"><a href="action_meDel?action=delete&restname=<?php echo $restname; ?>&num1=<?php echo $v4->m_num; ?>"><img src="icon/x.jpeg" width="30" height="30"></a></td>
            </tr>
            <?php
        }
               ?>

    </table>
    <br>
    <input type="button" value="返回餐廳管理" onclick="self.location.href='restChooseV'"/>
    <br>
    <a href="restMenuInsert">新增菜單</a>
    <a href="restChooseV">餐廳管理</a>
    <a href="restKindManage">餐廳分類管理</a>
    <br>
    <a href="/">下單區</a>
    <a href="purchaseManageV">下單總覽</a>
    <br>
    <a href="orderManageV">訂單總覽</a>
</form>
</body>
</html>