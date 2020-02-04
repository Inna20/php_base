<?php

$sql = "SELECT id, login, password, is_admin FROM users";
$res = mysqli_query($link, $sql);

$html = '';
while ($row = mysqli_fetch_assoc($res))
{
    $html .=<<<php
        <a href="?page=3&id={$row['id']}">{$row['login']}</a>
php;

}

echo $html;