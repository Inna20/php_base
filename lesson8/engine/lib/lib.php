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
function isAdmin() {
    return (!empty($_SESSION['user']['is_admin'])) ? true : false;
}

function countInBasket() {
if (empty($_SESSION['goods'])) {
        return 0;
    }

    $count = 0;
    foreach ($_SESSION['goods'] as $good) {
        $count += $good['count'];
    }

    return $count;
}

function getMenu(){

    $menu = '<li><a href="?p=index">Главная</a></li>';
    $menu .= '<li><a href="?p=user">Пользователи</a></li>';
    $menu .= '<li><a href="?p=user&a=one">Пользователь</a></li>';
    $menu .= '<hr>';
    $menu .= '<li><a href="?p=product">Каталог товаров</a></li>';

    if (!empty($_SESSION['user']['id'])) {
        $menu .= '<li><a href="?p=auth">Личный кабинет</a></li>';
        $menu .= '<li><a href="?p=cart">Корзина</a></li>';
        $menu .= '<li><a href="?p=order">Мои заказы</a></li>';

        if(isAdmin()) {
            $menu .= '<li><a href="?p=order&a=all">Все заказы потльзователей</a></li>';
        }
        
    } else {
        $menu .= '<li><a href="?p=reg">Регистрация</a></li>';
        $menu .= '<li><a href="?p=auth">Авторизация</a></li>';
    }
    return $menu;

}

function getOrderStatusArray() {
    return [
                0 => 'Новый',
                1 => 'В обработке',
                2 => 'Доставлен',
                3 => 'Закрыт',
            ];
}