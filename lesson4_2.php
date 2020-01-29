<?php
	// логирование

	$log_file_name = "log/log.txt";

	if(is_file($log_file_name)) {
		$arr = file($log_file_name, FILE_SKIP_EMPTY_LINES);

		if (count($arr) >= 10) { // переименуем существующий и начнем записывать в новый файл
			$new_log_file_name = "log/log" . time(). ".txt";
			rename($log_file_name, $new_log_file_name);
		}
	}

	file_put_contents($log_file_name, date('Y-m-d H:i:s') . "\r\n", FILE_APPEND);

?>