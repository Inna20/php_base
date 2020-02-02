<?php
$page = (!empty($_GET['referer_page'])) ? $_GET['referer_page'] : 1;
$page = '?page='.$page;

// Если данные формы не передаются
if (empty($_POST['number1']) || empty($_POST['number2']) || empty($_POST['operator'])) {

	header('location: '. $page);
	exit;
}

$result = '';

if (function_exists(trim($_POST['operator']))) {
	
	$result = $_POST['operator']($_POST['number1'], $_POST['number2']);
	$result = '&result='.$result;
}

header('location: '. $page . $result);
?>