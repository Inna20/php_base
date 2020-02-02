<?php
    $msg = '';
    if (!empty($_GET['ok'])) {
        $msg = 'Добавлен';
    }
    echo $msg . '<hr>';
?>
<form method="post" action="?page=5">
    <input name="login" type="text" placeholder="login">
    <input name="password" type="text" placeholder="password">

    <input type="submit">
</form>
