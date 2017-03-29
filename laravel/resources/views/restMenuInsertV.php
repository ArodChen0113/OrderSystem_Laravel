<?php
include ("menu_js.js");
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>新增餐廳&菜單頁面</title>
</head>
<body>
<form action="action_rmInt" method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td colspan="4" align="center" bgcolor="#FFABFF">新增餐廳Menu</td>
        </tr>
        <tr>
            <td colspan="4" align="center" bgcolor="#ABFFFF">餐廳</td>
        </tr>
        <tr>
            <td align="center" bgcolor="#FFABAB">餐廳名稱</td>
            <td align="center" bgcolor="#FFE1AB">餐廳電話</td>
            <td align="center" bgcolor="#DBABFF">餐廳分類</td>
            <td align="center" bgcolor="#ABFFAB">上傳菜單圖片</td>
        </tr>
        <tr>
            <td><input type="text" name="restaurant_name" value="請填入餐廳名稱" onfocus="cleartext(this)" onblur="resettext(this)"></td>
            <td><input type="text" name="rest_tel"></td>
            <td><select name="restkind">
                    <?php
                    foreach ($result as $i){ ?>　
                        <option value="<?php echo $i->rest_kind; ?>"><?php echo $i->rest_kind; ?></option>
                        <?php
                    }
                    ?>
                </select></td>
            <td><input type="file" name="rest_picture" size="30"></td>
        </tr>
    </table>

<table border="1">
    <tr>
        <td colspan="4" align="center" bgcolor="#A3A3FF">菜單</td>
    </tr>
    <tr>
        <td align="center" bgcolor="#FFB5B5">項目</td>
        <td align="center" bgcolor="#FFE5B5">單價</td>
        <td align="center" bgcolor="#DBABFF">上傳料理圖片</td>
    </tr>
    <tr>
        <td><input type="text" name="kind[]"></td>
        <td><input type="text" name="price[]"></td>
        <td><input type="file" name="menu_picture[]" size="30"></td>
    </tr>
    <tr>
        <td><input type="text" name="kind[]"></td>
        <td><input type="text" name="price[]"></td>
        <td><input type="file" name="menu_picture[]" size="30"></td>
    </tr>
    <tr>
        <td><input type="text" name="kind[]"></td>
        <td><input type="text" name="price[]"></td>
        <td><input type="file" name="menu_picture[]" size="30"></td>
    </tr>
    <tr>
        <td><input type="text" name="kind[]"></td>
        <td><input type="text" name="price[]"></td>
        <td><input type="file" name="menu_picture[]" size="30"></td>
    </tr>
    <tr>
        <td><input type="text" name="kind[]"></td>
        <td><input type="text" name="price[]"></td>
        <td><input type="file" name="menu_picture[]" size="30"></td>
    </tr>
    <tr>
        <td><input type="text" name="kind[]"></td>
        <td><input type="text" name="price[]"></td>
        <td><input type="file" name="menu_picture[]" size="30"></td>
    </tr>
    <tr>
        <td><input type="text" name="kind[]"></td>
        <td><input type="text" name="price[]"></td>
        <td><input type="file" name="menu_picture[]" size="30"></td>
    </tr>
    <tr>
        <td><input type="text" name="kind[]"></td>
        <td><input type="text" name="price[]"></td>
        <td><input type="file" name="menu_picture[]" size="30"></td>
    </tr>
    <tr>
        <td><input type="text" name="kind[]"></td>
        <td><input type="text" name="price[]"></td>
        <td><input type="file" name="menu_picture[]" size="30"></td>
    </tr>
    <tr>
        <td><input type="text" name="kind[]"></td>
        <td><input type="text" name="price[]"></td>
        <td><input type="file" name="menu_picture[]" size="30"></td>
    </tr>
</table>
    <br>
    <input type="hidden" name="action" value="insert">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="submit" value="新增菜單">
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