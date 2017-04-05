<?php
session_start();
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>餐廳選擇器</title>
</head>
<body>
<form name="rest_management" action="restManageV" method="post" enctype="multipart/form-data">
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
        <td><select style="width:240px" name="restKind" onchange="window.location='restChooseV?control=1&restKind='+this.value">
                <?php if($control==0){
                ?>
                <option value="">請選擇</option>
                <?php }else{ ?>
                    <option value="<?php echo $chooseKind; ?>"><?php echo $chooseKind; ?></option>
                    <?php
                }
                $num=count($restKind);
                for ($k=0;$k<=$num-1;$k++){
                    $value=$restKind[$k];
                    ?>
                        <option value="<?php echo $value->rest_kind; ?>"><?php echo $value->rest_kind; ?></option>
                        <?php
                    }
                ?>
            </select></td>
        <td><select style="width:240px" name="restName" onchange="window.location='restChooseV?control=2&restKind=<?php echo $chooseKind; ?>&restName='+this.value">
                <?php
                if($control==0){
                    ?>
                    <option value="">請選擇</option>
                <?php
                }else if($control==1){
                    ?>
                    <option value="">請選擇</option>
                    <?php
                    $num=count($restName);
                    for ($k=0;$k<=$num-1;$k++){
                        $value=$restName[$k];
                        ?>
                        <option value="<?php echo $value->rest_name; ?>"><?php echo $value->rest_name; ?></option>
                    <?php
                    }
                }else if($control==2){
                    ?>
                    <option value="<?php echo $chooseName; ?>"><?php echo $chooseName; ?></option>
                    <?php
                $num=count($restName);
                for ($k=0;$k<=$num-1;$k++){
                    $value=$restName[$k];
                    ?>
                    <option value="<?php echo $value->rest_name; ?>"><?php echo $value->rest_name; ?></option>
                    <?php
                }}
                ?>
            </select></td>
    </tr>
</table>
    <input type="hidden" name="restName" value="<?php echo $chooseName; ?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <br>
    選擇好餐廳，按下搜尋按鈕 >>>
    <input type="submit" value="瀏覽菜單">
    如欲<font color="#FF0000">更換今日開餐</font>，按下開餐按鈕 >>>
    <input type="button" value="開餐" onclick="self.location.href='openMealV'"/>

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