<?php

/*
1. С помощью цикла while вывести все числа в промежутке от 0 до 100, которые делятся на 3 без остатка.
*/
// за 100 итераций
$i = 0;
while($i <= 100) {
	if ($i%3 == 0) {
		echo $i . ' ';
	}
	$i++;
}
echo "<hr>";

// за 33 итерации
$j = 1;
echo '0 '; // 0 в диапазоне и делится на 3	
while($j*3 <= 100) {
	echo $j*3 . ' ';
	$j++;
}

echo "<hr>";

/*
2. С помощью цикла do…while написать функцию для вывода чисел от 0 до 10
*/
$i = 0;
do {
	if ($i == 0) {
		echo "{$i} - ноль<br>";
	}
	elseif ($i%2 == 0) {
		echo "{$i} - четное число<br>";
	} else {
		echo "{$i} - нечетное число<br>";
	}
	$i++;
} while ($i <= 10);

echo "<hr>";
/*
3. Объявить массив, в котором в качестве ключей будут использоваться названия областей, а в качестве значений – массивы с названиями городов из соответствующей области. Вывести в цикле значения массива, чтобы результат был таким:
Московская область:
Москва, Зеленоград, Клин
Ленинградская область:
Санкт-Петербург, Всеволожск, Павловск, Кронштадт
Рязанская область 
*/

$arrayCities = [
	'Московская область'    => ['Москва', 'Зеленоград', 'Клин', 'Красногорск'],
	'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
	'Тверская область'      => ['Тверь', 'Торжок', 'Осташков'],
	'Ростовская область'    => ['Ростов-на-Дону', 'Таганрог', 'Каменск']
];

// foreach ($arrayCities as $key => $cities) {
// 	echo $key.":<br>";
// 	foreach ($cities as $i => $city) {
// 		if ($i != 0)
// 			echo ', ';
// 		echo $city;
// 	}
// 	echo "<br>";
// }
// echo "<hr>";

//за один цикл
foreach ($arrayCities as $key => $cities) {
	echo $key.":<br>";
	echo implode(', ', $cities) . "<br>";
}
echo "<hr>";

/*
4. Объявить массив, индексами которого являются буквы русского языка, а значениями – соответствующие латинские буквосочетания (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’).
Написать функцию транслитерации строк.
*/
function translit($str) {

	$dictionary = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '',    'ы' => 'y',   'ъ' => '', 
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya');
	return strtr($str, $dictionary);
}

$str = "привет мир!";

echo translit($str);

echo "<hr>";

/*
5. Написать функцию, которая заменяет в строке пробелы на подчеркивания и возвращает видоизмененную строчку.
*/
function spaceReplace($str) {
	return str_replace(' ', '_', $str);
}
echo spaceReplace("Я люблю учиться");

/*
6. В имеющемся шаблоне сайта заменить статичное меню (ul – li) на генерируемое через PHP. Необходимо представить пункты меню как элементы массива и вывести их циклом. Подумать, как можно реализовать меню с вложенными подменю? Попробовать его реализовать.
*/

$menuArray = [
	'Главная',
	'Новости' => ['Новости о спорте', 'Новости о политике', 'Новости о мире'],
	'Контакты',
	'Справка'
];

$menu = '';

foreach ($menuArray as $key => $item) {
	if (is_array($item)) {
		$menu .= "<div>";
		$menu .= "<a><span>{$key}</span></a>";
		$menu .= "<div>";

		foreach ($item as $subItem) {
			$menu .= "<a>{$subItem}</a>";
		}

		$menu .= "</div>";
		$menu .= "</div>";
	
	} else {
		$menu .= "<div><a><span>{$item}</span></a></div>";
	}
}
$html = file_get_contents('lesson3.html');
$html = str_replace('{MENU}', $menu, $html);
//echo $html;

echo "<hr>";

/*
7. *Вывести с помощью цикла for числа от 0 до 9, не используя тело цикла. Выглядеть должно так:
for (…){ // здесь пусто}
*/
for($i = 0; $i < 10; print $i++){}

echo "<hr>";

/*
8. *Повторить третье задание, но вывести на экран только города, начинающиеся с буквы «К».
*/

$arrayCities = [
	'Московская область'    => ['Москва', 'Зеленоград', 'Клин', 'Красногорск'],
	'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'],
	'Тверская область'      => ['Тверь', 'Торжок', 'Осташков'],
	'Ростовская область'    => ['Ростов-на-Дону', 'Таганрог', 'Каменск']
];

foreach ($arrayCities as $key => $cities) {
	echo $key.":<br>";

	$newCities = array_filter($cities, function($item){
		return mb_substr($item, 0, 1) == 'К';
	});

	echo implode(', ', $newCities) . "<br>";
}
echo "<hr>";

/*
9. *Объединить две ранее написанные функции в одну, которая получает строку на русском языке, производит транслитерацию и замену пробелов на подчеркивания (аналогичная задача решается при конструировании url-адресов на основе названия статьи в блогах).
*/

function formatUrl($str) {
	return spaceReplace(translit(mb_strtolower($str)));
}
echo formatUrl("Я люблю учиться");

?>