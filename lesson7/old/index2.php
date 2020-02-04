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

ob_start();
include __DIR__ . '/pages/' . $page;
$content = ob_get_clean();
?>


<ul>
    <li><a href="?page=1">Главная</a></li>
    <li><a href="?page=2">Пользователи</a></li>
    <li><a href="?page=4">Добавить пользователя</a></li>
</ul>

<? echo $content;?>