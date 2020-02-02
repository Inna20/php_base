<?php
$db = db_connect();

if (!empty($_GET['id'])) {
	$id = (int)$_GET['id'];
	$content = getImage($id, $db);
	increment_view($id, $db);

} else {
	$content = getGallery($db);
}

$tmpl = file_get_contents('template.tpl');
echo str_replace('{CONTENT}', $content, $tmpl);


function db_connect() {
	$link = mysqli_connect("127.0.0.1", "root", "", "geek_php_base");
	if (!$link) {
	    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
	    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}
	return $link;
}

function getGallery($db) {

	$sql = <<<sql
		select * from gallery 
		order by views DESC
sql;
	$gallery = mysqli_query($db, $sql);

	$content = '<ul id="gallery">';
	while($res = mysqli_fetch_assoc($gallery)) {
		
		$content .= '<li><a href="?id=' .$res['id'].'"><img src="' . $res['url'].'" width="150" /></a>';
	}
	$content .= '</ul>';

	return $content;
}

function getImage($id, $db) {
	$db = db_connect();

	$sql = <<<sql
		select url from gallery 
		where id = $id
sql;
	$gallery = mysqli_query($db, $sql);

	$img = mysqli_fetch_assoc($gallery);

	if (!$img) {
		redirect();
	}

	return '<img src="'.$img['url'].'"/>';
}

function redirect() {
	header('location: ?');
	exit;
}

function increment_view($id, $db) {
	$sqlUpdate = <<<sql
				update gallery
				set views = views+1
				where id = $id
sql;
	mysqli_query($db, $sqlUpdate);
}
?>
