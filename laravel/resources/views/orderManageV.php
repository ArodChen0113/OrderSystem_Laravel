<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>訂單管理頁面</title>
</head>
<body>
<form action="orderPay_update.php" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td colspan="3" align="center" bgcolor="#ABFFFF">訂單總覽</td>
        </tr>
        <tr>
            <td colspan="2" align="center" bgcolor="#FFABAB">今日訂餐：<?php echo $open_restName;?></td>
            <td colspan="1" align="center" bgcolor="#FFE1AB">餐廳電話：<?php echo $open_restTel;?></td>
        </tr>
        <tr>
            <td align="center" width="300px" bgcolor="#FFE1AB">訂購人</td>
            <td align="center" width="300px" bgcolor="#DBABFF">訂購金額</td>
            <td align="center" width="300px" bgcolor="#FFABAB">繳費</td>
        </tr>
        <?php
        $num=count($order_data);
        for($k=0;$k<=$num-1;$k++) {
        $v = $order_data[$k];
        ?>
        <tr>
            <?php
            echo "<td align=\"center\"><b>" . $v->name . "</<b></td>";
            echo "<td align=\"center\"><b>" . $v->price . "</<b></td>";
            ?>
            <td align="center">
                <?php
                if ($v->pay == 0) {
                    ?>
                    <font color="#FF0000">尚未繳費</font>
                    <a href="action_orPay?action=pay&payname=<?php echo $v->name; ?>"><img
                                src="th.jpeg" width="30" height="30"></a>
                <?php } else if ($v->pay == 1) {
                    ?>
                    已繳費
                    <?php
                    ?>
            </td>
            <?php
            }
                ?>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td align="center">訂餐人數</td><td align="center" colspan="2"><?php echo count($order_people); ?></td>
        </tr>
        <tr>
            <td align="center">餐點數量</td><td align="center" colspan="2"><?php echo count($orderCount); ?>
            </td>
        </tr>
        <tr>
            <td align="center">金額總計</td><td align="center" colspan="2"><?php echo $totalPrice; ?>
            </td>
        </tr>
    </table>

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
<br>
<form action="" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td colspan="5" align="center" bgcolor="#ABFFFF">以菜單分類</td>
        </tr>
        <tr>
            <td align="center" width="300px" bgcolor="#FFE1AB">菜單</td>
            <td align="center" width="300px" bgcolor="#ABFFAB">圖片</td>
            <td align="center" width="300px" bgcolor="#00FFFF">訂購數量</td>
            <td align="center" width="300px" bgcolor="#DBABFF">單價</td>
            <td align="center" width="300px" bgcolor="#FFABAB">訂購人</td>
        </tr>
        <?php
        $num=count($order_menu);
        for($k=0;$k<=$num-1;$k++) {
            $v2=$order_menu[$k];
            ?>
            <tr>
                <?php
                    echo "<td align=\"center\"><b>" . $v2->kind . "</<b></td>";
                    ?>
                <td align="center"><img src="photo/<?php echo $order_pic[$k] ; ?>" width="150" height="150"></td>
                <?php
                    echo "<td align=\"center\"><b>" . $kindCount[$k] . "</<b></td>";
                    echo "<td align=\"center\"><b>" . $order_unitPrice[$k] . "</<b></td>";
?>
                <td align="center"><b>
                        <?php
                        foreach ($kindOrderName[$k] as $i) {
                            echo $i->name." ";
                        }
                        ?>
                    </<b></td>
            </tr>
            <?php
        }
        ?>
    </table>
</form>
</body>
</html>