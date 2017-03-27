<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>
<body>

<?php
echo Form::open(['url' => 'foo/bar', 'method' => 'pot']);
echo Form::text('username');
echo "</br>";
echo Form::select('size', ['L' => 'Large', 'S' => 'Small']);
echo Form::select('size', array('L' => 'Large', 'S' => 'Small'), null, array('multiple' => true));
echo Form::select('animal', [
    'Cats' => ['leopard' => 'Leopard'],
    'Dogs' => ['spaniel' => 'Spaniel'],
]);
echo Form::selectRange('number', 10, 20);
echo Form::close();
?>
</body>
</html>