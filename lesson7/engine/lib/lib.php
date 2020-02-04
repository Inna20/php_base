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