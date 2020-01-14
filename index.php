<?php
	$h1 = "Поменять местами значения переменных";
	$year = date('Y');
	$title = "Домашнее задание 1";
	$a = 3;
	$b = 5;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>
<body>
	<h1><?php echo $h1; ?></h1>
	<p>Текущий год: <?php echo $year; ?>
	<p>Переменная a = <?echo $a; ?></p>
	<p>Переменная b = <?echo $b; ?></p>

<?php
	$a = $a+$b;
	$b = $a-$b;
	$a = $a-$b;
?>

	<p>Результат:</p>
	<p>Переменная a = <?echo $a; ?></p>
	<p>Переменная b = <?echo $b; ?></p>
</body>
</html>
