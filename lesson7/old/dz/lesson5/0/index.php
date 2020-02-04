<?php
/*
 * 1. Создать галерею изображений, состоящую из двух страниц:
 * просмотр всех фотографий (уменьшенных копий);
 * просмотр конкретной фотографии (изображение оригинального размера) по ее ID в базе данных.
 *
 * 2. В базе данных создать таблицу, в которой будет храниться информация о картинках (адрес на сервере, размер, имя).
 *
 * 3. *На странице просмотра фотографии полного размера под картинкой должно быть указано число ее просмотров.
 *
 * 4. *На странице просмотра галереи список фотографий должен быть отсортирован по популярности.
 * Популярность = число кликов по фотографии.
*/
define(HOST, 'localhost');
define(USER, 'root');
define(PASS, '123456');
define(DB, 'gbphp');

$link = mysqli_connect(HOST, USER, PASS, DB);
$id = (int)$_GET['id'];
$html = "";
if(empty($id))
{
    $sql = "SELECT id,name,path_thumb FROM images ORDER BY views DESC";
    $res = mysqli_query($link, $sql);
    $html .= '<div class="gallery">';
    while ($row = mysqli_fetch_assoc($res))
    {
        $thumb_name = explode('.', $row['name']);
        $html .= '<a href="?id=' . $row['id'] . '" class="img_link">';
        $html .= '<img src="' . $row['path_thumb'] . '/' . $thumb_name[0] . '_thumb.' . $thumb_name[1] . '" class="image" alt=""/>';
        $html .= '</a>';
    }
    $html .= '</div>';
}
else
{
    $select_sql = "SELECT id,name,path_full,views FROM images WHERE id=$id";
    $res = mysqli_query($link, $select_sql);
    $row = mysqli_fetch_assoc($res);
    $views = (!empty($row['views'])) ? ++$row['views'] : 1;
    $html .= '<img src="' . $row['path_full'] . '/' . $row['name'] . '" class="full__image" alt=""/>';
    $html .= '<div class="counter">Просмотры: ' . $views . '</div>';
    $update_sql =  "UPDATE images SET views = $views WHERE id = $id";
    $result = mysqli_query($link, $update_sql) or die(mysqli_error($link));
}
$template = file_get_contents('gallery.tpl');
$template = str_replace('{gallery}', $html, $template);
echo $template;