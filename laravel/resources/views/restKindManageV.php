<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>餐廳分類管理頁面</title>
</head>
<body>
<form name="from1" action="action_rKUp" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td colspan="2" align="center" bgcolor="#ABFFFF">分類管理</td>
        </tr>
        <tr>
            <td align="center" bgcolor="#FFABAB">分類名稱</td>
            <td align="center" bgcolor="#FFE5B5">刪除</td>
        </tr>
        <?php
        $num=count($restData);
        for($k=0;$k<=$num-1;$k++) {
            $value=$restData[$k];
?>
        <tr>
            <td><input type="text" name="restKind[]" value="<?php echo $value->rest_kind; ?>"></td>
            <input type="hidden" name="num[]" value="<?php echo $value->num ;?>">
            <td align="center"><a href="action_rKDel?action=delete&num=<?php echo $value->num ?>"><img src="icon/x.jpeg" width="30" height="30"></a></td>
        </tr>
            <?php
        }?>
    </table>
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="action" value="update">
    如欲<font color="#FF0000">修改</font>餐廳分類，按下修改按鈕 >>>
    <input type="submit" value="修改分類">
</form>

<form name="from2" action="action_rKInt" method="post" enctype="multipart/form-data">
<table border="1">
        <tr>
            <td align="center" bgcolor="#FFABAB">新增分類</td>
            <td align="center"><input type="text" name="restKind"></td>
        </tr>
    </table>
    <br>
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="action" value="insert">
    如欲<font color="#FF0000">新增</font>餐廳分類，按下新增按鈕 >>>
    <input type="submit" value="新增分類">
</form>
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