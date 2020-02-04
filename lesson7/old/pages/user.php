<?php

$id = (int)$_GET['id'];
$sql = "SELECT id, login, password, is_admin FROM users WHERE id = " . $id;
$res = mysqli_query($link, $sql);

$html = '';
$row = mysqli_fetch_assoc($res);
    $html .=<<<php
        <a href="?id={$row['id']}">{$row['login']}</a>
        <hr>
        {$row['is_admin']}
        
php;

echo $html;