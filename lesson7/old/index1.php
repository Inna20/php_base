<a href="?key[dopkey]=1&key[1][query]=tyu&key[1][answer]=asda&key[1][ball]=12&key[2][query]=tyu&key[2][answer]=asda&key[2][ball]=12">
    link
</a>


<form method="post" action="?key1=sdfkjgkjhg">
    <input  type="text" placeholder="name">
    <input  type="text" placeholder="name2">


    <input type="submit">
</form>

<hr>
<form enctype="multipart/form-data"  method="POST">
    Отправить этот файл: <input name="userfile" type="file" />
    <input type="submit" value="Отправить файл" />
</form>

<?php

var_dump($_GET);
var_dump($_POST);
var_dump($_FILES);
//var_dump($_SERVER);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['userfile'])) {
        $fileName = __DIR__ . '/' . $_FILES['userfile']['name'];
        copy($_FILES['userfile']['tmp_name'], $fileName);
    }
}