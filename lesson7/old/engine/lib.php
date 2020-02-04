<?php

function clearStr($str)
{
    global $link;

    $str = trim($str);
    $str = strip_tags($str);
    $str = mysqli_real_escape_string($link, $str);

    return $str;
}