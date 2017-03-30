<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>訂購單管理頁面</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td colspan="3" align="center" bgcolor="#ABFFFF">下單總覽</td>
        </tr>
        <tr>
            <td align="center" width="300px" bgcolor="#FFE1AB">訂購者</td>
            <td align="center" width="300px" bgcolor="#ABFFAB">總額</td>
            <td align="center" width="300px" bgcolor="#DBABFF">瀏覽修改</td>
        </tr>

        <?php
        if($orderData!=NULL){
        $num=count($orderData);
        for($k=0;$k<=$num-1;$k++) {
            $value=$orderData[$k];
            ?>
            <tr>
                <td align="center"><?php echo $value->name; ?></td>
                <td align="center"><?php echo $value->price; ?></td>
                <td align="center"><a href="purchaseUpdateV?orderName=<?php echo $value->name; ?>"><img
                                src="icon/eye.jpeg" width="30" height="30"></a></td>
            </tr>
            <?php
        }
        }else{
            ?>
            <tr>
                <td colspan="3" align="center">今日尚無訂餐</td>
            </tr>
            <?php
        }
        ?>
    </table>
    <br>
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
        <td align="center" bgcolor="#FFD4D4">今日開餐: <?php echo $restName; ?></td>
    </tr>
    <tr>
        <td><img src="/userUpload/<?php echo $restPic; ?>" width="800" height="600"></td>
    </tr>
</table>
</body>
</html>