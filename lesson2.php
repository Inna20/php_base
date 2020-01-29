<?php
/*
1. Объявить две целочисленные переменные $a и $b и задать им произвольные начальные значения. Затем написать скрипт, который работает по следующему принципу:
если $a и $b положительные, вывести их разность;
если $а и $b отрицательные, вывести их произведение;
если $а и $b разных знаков, вывести их сумму;
*/

$a = rand(-100, 100);
$b = rand(-100, 100);

echo $a . ' ' . $b;

if ($a >= 0 && $b >= 0) {
	echo " a и b положительные, их разность: ". ($a - $b);

} elseif ($a < 0 && $b < 0) {
	echo " а и b отрицательные, их произведение: " . ($a * $b);

} else {
	echo " а и b разных знаков, их сумма: " . ($a + $b);
}

echo "<hr>";
/*
2. Присвоить переменной $а значение в промежутке [0..15]. С помощью оператора switch организовать вывод чисел от $a до 15.
*/

$a = $b = rand(0, 15);

for($a; $a <= 15; $a++) { // 15 case'ов рука не поднялась писать
	echo $a .' ';
}

echo "<hr>";

switch ($b) {
	case '0':
		echo '0 ';
	case '1':
		echo '1 ';
	case '2':
		echo '2 ';
	case '3':
		echo '3 ';
	case '4':
		echo '4 ';
	case '5':
		echo '5 ';
	case '6':
		echo '6 ';
	case '7':
		echo '7 ';
	case '8':
		echo '8 ';
	case '9':
		echo '9 ';
	case '10':
		echo '10 ';
	case '11':
		echo '11 ';
	case '12':
		echo '12 ';
	case '13':
		echo '13 ';
	case '14':
		echo '14 ';
	case '15':
		echo '15 ';
};

echo "<hr>";

/*
3. Реализовать основные 4 арифметические операции в виде функций с двумя параметрами. Обязательно использовать оператор return.
*/

function sum($a, $b) {
	return $a + $b;
}
function subtract($a, $b) {
	return $a - $b;
}
function multipl($a, $b){
	return $a * $b;
}
function division($a, $b) {
	return $a / $b;
}

/*
4. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции.
*/

function math($a, $b, $operation) {
	switch ($operation) {
		case 'sum':
			return sum($a, $b);
		case 'subtract':
			return subtract($a, $b);
		case 'multipl':
			return multipl($a, $b);
		case 'division':
			return division($a, $b);
		default:
			return "Нет такой операции";
	}
}

// Рабочий вариант

// function math($a, $b, $operation) {
// 		return $operation($a, $b);
// }

// Проверка
$data = ['sum', 'subtract', 'multipl', 'division'];
$a = 5;
$b = 3;
$do = $data[rand(0, 3)];

echo $do . " " . math($a, $b, $do);

echo "<hr>";

/* 
5. Посмотреть на встроенные функции PHP. Используя имеющийся HTML-шаблон, вывести текущий год в подвале при помощи встроенных функций PHP.
*/

$html = file_get_contents('tmpl.html');
$data = array('Урок 2', 'Hello World', date('Y'));
echo str_replace(array('{TITLE}', '{CONTENT}', '{CURRENTYEAR}'), $data, $html);

echo "<hr>";

/*
6. *С помощью рекурсии организовать функцию возведения числа в степень. Формат: function power($val, $pow), где $val – заданное число, $pow – степень.
*/
function power($val, $pow, $res = 1, $cur = 0) {

	if ($cur < $pow) {
		return power($val, $pow, $val*$res, ++$cur);
	} else {
		return $res;
	}

}
// Проверка
echo power(2, 8);

echo "<hr>";

function power2($val, $pow) {
	if ($pow == 0) {
		return 1;
	}
	$pow--;
	return power2($val, $pow--) * $val;
}
// Проверка
echo power2(2, 10);

echo "<hr>";


/*
7. *Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями, например:
22 часа 15 минут
21 час 43 минуты
*/
function fornatTime() {
	$curData = getdate(time());
	$hours   = $curData['hours'];
	$minutes = $curData['minutes'];

	return "Текущее время " . $hours . " час" . wordEnds($hours)['hours_end'] . ", " 
		. $minutes . " минут" . wordEnds($minutes)['minutes_end'];
}

function wordEnds($digit) {

	if ($digit > 15) {
		$digit = substr($digit, -1);
	}

	$res = array(
		'hours_end' => '',
		'minutes_end' => '');

	if ($digit == 1) {
		$res['hours_end']   = '';
		$res['minutes_end'] = 'a';

	} elseif (in_array($digit, array(2,3,4))) {
		$res['hours_end']   = 'а';
		$res['minutes_end'] = 'ы';

	} else {
		$res['hours_end']   = 'ов';
		$res['minutes_end'] = '';
	}

	return $res;
}

date_default_timezone_set("Europe/Moscow"); // почемуто у меня в настройках другое
echo fornatTime();

?>