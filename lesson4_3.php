<?php
	// Список каталогов и файлов

function myScan($dir, $delim = '') {

		$dir_arr = scandir($dir);

		foreach ($dir_arr as $item) {
			if($item == "." || $item == "..") {
			 	continue;
			}
	
			echo $delim . $item . "<br>" ;

			if (is_dir($dir ."/" .$item)) {	

				$delim .= "&nbsp;&nbsp;";
				myScan($dir ."/" .$item, $delim);
			}
		}
	}

	myScan("test");
?>