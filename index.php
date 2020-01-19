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

	list($b, $a) = [$a, $b];

?>

	<p>Переменная a = <?echo $a; ?></p>
	<p>Переменная b = <?echo $b; ?></p>

<?php
	$a = $a+$b;
	$b = $a-$b;
	$a = $a-$b;
?>
<hr>
	<p>Результат:</p>
	<p>Переменная a = <?echo $a; ?></p>
	<p>Переменная b = <?echo $b; ?></p>

	<hr>

<?php
    $a = 5;
    $b = '05';
    var_dump($a == $b);         // нестрогое равенство + приведение типов к int
    var_dump((int)'012345');     // приведение типов к int
    var_dump((float)123.0 === (int)123.0); // строгое равенство, учитывается тип переменных
    var_dump((int)0 === (int)'hello, world'); // сравниваются переменные с одним типом, а строка без первой цифры равноа 0
?>
</body>
</html>
