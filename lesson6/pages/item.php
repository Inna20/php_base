<?php
	if (empty($_GET['id'])) {
		header('location: ?page=5');
		exit;
	}

	$id = (int)$_GET['id'];
	$content = getProduct($id);
	incrementProduct_view($id);

	// Если есть отзывы
	$reviews = getRewiews($id);

	$tmpl = file_get_contents($tpl);
	echo str_replace(array('{PRODUCT_ID}', '{CONTENT}', '{REVIEW}'), array($id, $content, $reviews), $tmpl);
?>