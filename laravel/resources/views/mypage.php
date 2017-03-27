
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>
<body>
<?php
//echo Form::open(['url'=>'123', 'method'=>'post']);
//echo Form::label('title', 'Title');
//echo Form::text('action');
//echo Form::label('content');
//echo Form::textarea('content');
//echo Form::submit('發表文章');
//echo Form::close();
//?>

<form action="test.php" method="post" enctype="multipart/form-data">
    <td><input type="text" name="action"></td>
<!--    <input type="hidden" name="action" value="insert">-->
    <td><input type="file" name="rest_picture" size="30"></td>
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <input type="submit" value="新增菜單">
</form>
</body>
</html>