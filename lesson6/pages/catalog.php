<?php
$content = getProducts();

$tmpl = file_get_contents($tpl);
echo str_replace('{CONTENT}', $content, $tmpl);
?>