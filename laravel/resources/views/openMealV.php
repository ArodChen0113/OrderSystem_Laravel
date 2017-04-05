<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>今日開餐</title>
</head>
<body>
<form name="rest_management" action="action_openMeal" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td colspan="3" align="center" bgcolor="#FFABAB">餐廳管理</td>
        </tr>
        <tr>
            <td align="center"></td>
            <td align="center" bgcolor="#DBABFF">餐廳名稱</td>
        </tr>
        <tr>
            <td>請選擇今日開餐：</td>
            <td><select style="width:240px" name="restChoose" onchange="window.location='openMealV?restName='+this.value">

                    <option value=""><?php
                        if($restName==NULL){
                            echo "請選擇";
                        }else{
                        echo $restName;}?></option>
                    <?php
                    $num=count($openMeal);
                    for ($k=0;$k<=$num-1;$k++){
                        $value=$openMeal[$k];
                        ?>
                        <option value="<?php echo $value->rest_name; ?>"><?php echo $value->rest_name; ?></option>
                        <?php
                    }
                    ?>
                </select></td>
        </tr>
    </table>
        <table border="1">
            <?php if($restName!=NULL){?>
            <tr>
                <td align="center" bgcolor="#ABFFFF">所選餐廳: <?php echo $restName; ?></td>
            </tr>
            <tr>
                <td><img src="/userUpload/<?php echo $restPic; ?>" width="800" height="600"></td>
            </tr>
            <?php } ?>
        </table>
    <br>
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="restName" value="<?php echo $restName; ?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    選擇好餐廳，按下<font color="#FF0000">開餐</font>按鈕 >>>
    <input type="submit" value="確定開餐">
    <br>
    <a href="restMenuInsertV">新增菜單</a>
    <a href="restChooseV">餐廳管理</a>
    <a href="restKindManageV">餐廳分類管理</a>
    <br>
    <a href="/">下單區</a>
    <a href="purchaseManageV">下單總覽</a>
    <br>
    <a href="orderManageV">訂單總覽</a>

</body>
</html>