<?php
    include __DIR__ . '/engine/db.php';
    include __DIR__ . '/engine/lib.php';

    $pageId = 1;
if (!empty($_GET['page'])) {
    $pageId = $_GET['page'];
}
$pagesInfo = include 'config/pagesInfo.php';
$page = 'main.php';
if (!empty($pagesInfo[$pageId])) {
    $page = $pagesInfo[$pageId];
}

// шаблон страницы
$tplInfo = include 'config/tplConfig.php';
$tpl = (!empty($tplInfo[$pageId])) ? $tplInfo[$pageId] : 'tpl/index.tpl';


ob_start();
include __DIR__ . '/pages/' . $page;
$page_tmpl = ob_get_clean();

$menu = <<<menu
	<ul>
	    <li><a href="?page=1">Главная</a></li>
	    <li><a href="?page=2">Калькулятор1</a></li>
	    <li><a href="?page=3">Калькулятор2</a></li>
	    <li><a href="?page=5">Каталог</a></li>
	</ul>
menu;

// общий шаблон
$tmpl = file_get_contents('tpl/main.tpl');
$tmpl = str_replace(array('{MENU}', '{PAGE}'), array($menu, $page_tmpl) , $tmpl);

?>


<? echo $tmpl;?>

