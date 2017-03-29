<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>今日開餐</title>
</head>
<body>
<form name="rest_management" action="" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td colspan="3" align="center" bgcolor="#FFABAB">餐廳管理</td>
        </tr>
        <tr>
            <td align="center"></td>
            <td align="center" bgcolor="#ABFFFF">餐廳名稱</td>
        </tr>
        <tr>
            <td>請選擇今日開餐：</td>
            <td><select style="width:240px" name="restc1" onchange="window.location='openMealV2?select1='+this.value">
                    <option value="">請選擇</option>
                    <?php
                    $num=count($openMeal);
                    for ($k=0;$k<=$num-1;$k++){
                        $v=$openMeal[$k];
                        ?>
                        <option value="<?php echo $v->rest_name; ?>"><?php echo $v->rest_name; ?></option>
                        <?php
                    }
                    ?>
                </select></td>
        </tr>
    </table>
    <br>
    <input type="hidden" name="select_restName" value="">
    選擇好餐廳，按下<font color="#FF0000">開餐</font>按鈕 >>>
    <input type="submit" value="確定開餐">
    <br>
    <a href="restMenuInsert">新增菜單</a>
    <a href="restChooseV">餐廳管理</a>
    <a href="restKindManage">餐廳分類管理</a>
    <br>
    <a href="/">下單區</a>
    <a href="purchaseManageV">下單總覽</a>
    <br>
    <a href="orderManageV">訂單總覽</a>

</body>
</html>