<?php
function indexAction() {

    $tmpl = file_get_contents(dirname(__DIR__) . '/tmpl/reg.tpl');
    
    return $tmpl;
}

function addAction() {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        redirect("reg", "Что-то пошло не так");
    }

    if (empty(clearStr($_POST['login'])) || empty(clearStr($_POST['password'])) ) {
        redirect("reg", "Нет полных данных");
    }

    $login    = clearStr($_POST['login']);
    $password = clearStr($_POST['password']);
    $name     = clearStr($_POST['name']);
    $phone    = clearStr($_POST['phone']);
    $email    = clearStr($_POST['email']);

    if (loginExists($login)) {
        redirect("reg", "Пользователь с таким логином уже существует");
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    if (empty($password)) {
        redirect("reg", "Пустой пароль");
    }

    if (!isEmail($email)) {
        redirect("reg", "Не корректный email");
    }

    addUser($login, $password, $name, $phone, $email);

    redirect("reg", "Пользователь ". $login . " добавлен");
}

function isEmail($email) {
    $res = false;

    if (preg_match("/\w+@\w+\.\w+/", $email, $matches)) {
        $res = true;
    }
    
    return $res;
}

function loginExists($login) {
    $res = false;

     $sql = <<<sql
        select * from users 
        where login='{$login}'
sql;
    $products = mysqli_query(getConnect(), $sql);

    if (mysqli_num_rows($products) > 0) {
        $res = true;
    }

    return $res;
}

function addUser($login, $password, $name, $phone, $email) {
    $sql = <<<sql
        insert into users (login, password, name, phone, email)
        values ('$login', '$password', '$name', '$phone', '$email')

sql;
    mysqli_query(getConnect(), $sql);

    if (mysqli_affected_rows(getConnect()) < 1) {
        redirect("reg", "Ошибка сохранения данных");
    }
}

?>    