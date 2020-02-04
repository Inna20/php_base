<?php
//session_start();
//$link = mysqli_connect('localhost', 'root', '', 'gbphp');
//
//const SOL = 'Imple';
//
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    if (empty($_POST['login']) || empty($_POST['password']) ) {
//        header('Location: /');
//        exit;
//    }
//
//    $login = $_POST['login'];
//    $password = $_POST['password'];
//
//    $sql = "
//        SELECT
//            id, login, password, is_admin
//        FROM
//            users
//        WHERE
//            login = '$login'
//	";
//
//    $result = mysqli_query($link, $sql);
//    $user = mysqli_fetch_assoc($result);
//
//    if (empty($user)) {
//        header('Location: /');
//        exit;
//    }
//
//    if (password_verify($password, $user['password'])) {
//        $_SESSION['user'] = $login;
//    }
//
//    header('Location: /');
//    exit;
//}
//
//if (!empty($_GET['exit'])) {
//    session_destroy();
//    header('Location: /');
//    exit;
//}
//
//$html =<<<php
//<form method="post">
//    <input name="login" type="text" placeholder="login">
//    <input name="password" type="text" placeholder="password">
//    <input type="submit">
//</form>
//php;
//
//if (!empty($_SESSION['user'])) {
//    $html =<<<php
//    <a href="?exit=1">Выход</a>
//php;
//}
//
//echo $html;