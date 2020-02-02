<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ?page=4');
    exit;
}

$login = clearStr($_POST['login']);
$password = clearStr($_POST['password']);

$sql = "
        INSERT INTO users 
            (login, password) 
        VALUES 
               ('$login', '$password')
               ";
$res = mysqli_query($link, $sql);


header('Location: ?page=4&ok=1');
exit;