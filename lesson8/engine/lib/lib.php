<?php

/**
 * @return false|mysqli
 */
function getConnect()
{
    static $link;
    if (empty($link)) {
        $link = mysqli_connect('localhost', 'root', '', 'geek_php_base');
		mysqli_set_charset($link, "utf8");
    }
    return $link;
}

/**
 * @param $str
 * @return string
 */
function clearStr($str)
{
    $str = trim($str);
    $str = strip_tags($str);
    $str = mysqli_real_escape_string(getConnect(), $str);

    return $str;
}

function redirect($page = "index", $msg = "") {
	$_SESSION['msg'] = $msg; 
    header('location: ?p=' . $page);
    exit;
}

// new
function isAdmin()
{
    if (empty($_SESSION['user']['role'])) {
        header('Location: /');
        exit;
    }
}

function getMenu()
{
    $countInBasket = countInBasket();
    return <<<php
    <li><a href="/">Главная</a></li>
    <li><a href="?p=good">Товары</a></li>
    <li><a href="?p=basket">Корзина</a> <span id="countInBasket">$countInBasket</span></li>
    <li><a href="?p=user">Пользователи</a></li>
    <li><a href="?p=user&a=one">Пользователь</a></li>
    <li><a href="?p=index&a=about">О нас</a></li>
    <li><a href="?p=auth">Авторизация</a></li>
php;

}