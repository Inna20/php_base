<?php

function indexAction()
{
    $html =<<<php
    <h1>Авторизация</h1>
    <form method="post" action="?p=auth&a=auth">
        <input name="login" type="text" placeholder="login">
        <input name="password" type="text" placeholder="password">
        <input type="submit">
    </form>
php;

    if (!empty($_SESSION['user'])) {
        $html = <<<php

    <p>Ваше имя: {$_SESSION['user']['name']}</p>
    <p>Ваш телефон: {$_SESSION['user']['phone']}</p>
    <p>Ваш email: {$_SESSION['user']['email']}</p>
    <a href="?p=auth&a=exit">Выход</a>
php;
    }

    return $html;
}

function authAction()
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        header('Location: ?p=auth');
        $_SESSION['msg'] = 'Что-то пошло не так';
        exit;
    }

    if (empty($_POST['login']) || empty($_POST['password']) ) {
        $_SESSION['msg'] = 'Нет полных данных';
        header('Location: ?p=auth');
        exit;
    }

    $login    = $_POST['login'];
    $password = $_POST['password'];

    $sql = "
        SELECT 
            id, login, password, name, phone, email, address, is_admin
        FROM 
            users 
        WHERE 
            login = '$login'
	";

    $result = mysqli_query(getConnect(), $sql);
    $user = mysqli_fetch_assoc($result);

    $msg = 'Не верный логин или пароль';
    if (empty($user)) {
        header('Location: ?p=auth');
        $_SESSION['msg'] = $msg;
        exit;
    }

//    password_hash("asdasd", PASSWORD_DEFAULT);
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        $msg = 'Добро пожаловать ' . $user['name'];
    }

    $_SESSION['msg'] = $msg;

    header('Location: ?p=auth');
    exit;
}

function exitAction()
{
    session_destroy();
    header('Location: ?p=auth');
    exit;
}