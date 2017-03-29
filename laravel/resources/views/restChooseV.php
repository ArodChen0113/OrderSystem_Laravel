<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>餐廳選擇器</title>
</head>
<body>
<form name="rest_management" action="" method="post" enctype="multipart/form-data">
<table border="1">
    <tr>
        <td colspan="3" align="center" bgcolor="#DBABFF">餐廳管理</td>
    </tr>
    <tr>
        <td align="center"></td>
        <td align="center" bgcolor="#FFE1AB">分類</td>
        <td align="center" bgcolor="#ABFFAB">餐廳名稱</td>
    </tr>
    <tr>
        <td>請選擇欲瀏覽餐廳：</td>
        <td><select style="width:240px" name="restc1" onchange="window.location='action_rKControl1?action=control1&select1='+this.value">
                <option value="">請選擇</option>
                <?php
                $num=count($rest_kind_echo);
                for ($k=0;$k<=$num-1;$k++){
                    $v=$rest_kind_echo[$k];
                    ?>
                        <option value="<?php echo $v->rest_kind; ?>"><?php echo $v->rest_kind; ?></option>
                        <?php
                    }
                ?>
            </select></td>
    </tr>
</table>
    <br>
    <input type="hidden" name="select_restName" value="">
    選擇好餐廳，按下搜尋按鈕 >>>
    <input type="submit" value="瀏覽菜單">
    如欲<font color="#FF0000">更換今日開餐</font>，按下開餐按鈕 >>>
    <input type="button" value="開餐" onclick="self.location.href='openMealV'"/>
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