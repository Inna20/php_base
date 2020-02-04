<?php
	
	$tmpl = file_get_contents($tpl);

	$result = (!empty($_GET['result'])) ? 'Результат: '. (int)$_GET['result'] : '';
	echo str_replace(array('{RESULT}', '{REFERER_PAGE}'), array($result, $pageId), $tmpl);
?>