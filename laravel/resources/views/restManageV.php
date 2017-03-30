<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>餐廳管理頁面</title>
</head>
<body>
<form name="rest_open" action="action_reUp" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td colspan="3" align="center" bgcolor="#FFABAB">餐廳管理</td>
        </tr>
        <tr>
            <td align="center" bgcolor="#FFE1AB">餐廳名稱</td>
            <td align="center" bgcolor="#ABFFAB">分類</td>
            <td align="center" bgcolor="#DBABFF">電話</td>
        </tr>
        <tr>
            <td><input type="text" name="restName" value="<?php echo $restName;?>"></td>
            <td><input type="text" name="restKind" value="<?php echo $restKind;?>"></td>
            <td><input type="text" name="restTel" value="<?php echo $restTel;?>"></td>
        </tr>
        <tr>
            <td colspan="2" align="center" bgcolor="#ABFFFF">菜單</td>
            <td align="center" bgcolor="#DBABFF">上傳欲修改菜單圖片</td>
        </tr>
        <tr>
            <td colspan="2"><img src="/userUpload/<?php echo $restPic; ?>" width="800" height="600"></td>
            <td><input type="file" name="rest_picture" size="30"></td>
        </tr>
    </table>
    <br>
    <input type="hidden" name="num" value="<?php echo $restNum; ?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="hidden" name="action" value="update">
    如欲<font color="#FF0000">修改</font>餐廳資料，按下修改按鈕 >>>
    <input type="submit" value="確定修改">
    如欲瀏覽<font color="#FF0000">菜單</font>資料，按下瀏覽按鈕 >>>
    <input type="button" value="菜單瀏覽" onclick="self.location.href='menuV?restName=<?php echo $restName; ?>'"/>
    如欲<font color="#FF0000">刪除</font>這間餐廳，按下刪除按鈕 >>>
    <a href="action_reDel?action=delete&restname=<?php echo $restName; ?>"><img src="icon/x.jpeg" width="30" height="30"></a>
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
