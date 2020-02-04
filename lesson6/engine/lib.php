<?php

function clearStr($str)
{
    global $link;

    $str = trim($str);
    $str = strip_tags($str);
    $str = mysqli_real_escape_string($link, $str);

    return $str;
}

function sum($a, $b) {
	return $a + $b;
}
function subtract($a, $b) {
	return $a - $b;
}
function multipl($a, $b){
	return $a * $b;
}
function division($a, $b) {
	return $a / $b;
}

function getProducts() {

	global $link;

	$sql = <<<sql
		select * from products 
		order by views DESC
sql;
	$products = mysqli_query($link, $sql);

	$content = '<ul id="gallery">';
	while($res = mysqli_fetch_assoc($products)) {
		
		$content .= '<li><a href="?page=6&id=' .$res['id'].'"><img src="' . $res['url'].'" width="150" /></a></li>';
	}
	$content .= '</ul>';

	return $content;
}

function getProduct($id) {
	global $link;

	$sql = <<<sql
		select * from products
		where id = $id
sql;
	$product = mysqli_query($link, $sql);

	$item = mysqli_fetch_assoc($product);

	if (!$item) {
		header('Location: ?page=5');
		exit;
	}

	return '<img src="'.$item['url'].'" width="450"/>';
}


function incrementProduct_view($id) {
	global $link;

	$sqlUpdate = <<<sql
				update products
				set views = views+1
				where id = $id
sql;
	mysqli_query($link, $sqlUpdate);
}

function getRewiews($id) {
	global $link;

	$sql = <<<sql
		select * from product_review
		where product_id = $id
		order by id DESC
sql;
	$rewievs = mysqli_query($link, $sql);

	$content = '';
	if (mysqli_num_rows($rewievs)) {
		$content = '<h3>Отзывы</h3>';
		$content .= '<ul id="rewiews">';
		while($res = mysqli_fetch_assoc($rewievs)) {
			
			$content .= '<li><p><strong>'.$res['author'].'</strong></p>
						<p>'.$res['comment'].'</p></li>';
		}
		$content .= '</ul>';
	}

	return $content;

}