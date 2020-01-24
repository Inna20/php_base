<?php
	$dirname = 'imgs';

	if (!empty($_FILES['img'])) { // загружаем файл
		$upploaddir = __DIR__ . '/' . $dirname;
		$upploadfile = $upploaddir . '/'. basename($_FILES['img']['name']);

		if (move_uploaded_file($_FILES['img']['tmp_name'], $upploadfile)) {
		    echo "Файл был успешно загружен.<br>";
		} else {
		    echo "Ошибка загрузки<br>";
		}
	}

	$gallery = scandir($dirname);
?>

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-5">
	<style>
		#gallery {
			display: flex;
			list-style-type: none;
		}
		#gallery li {
			margin-right: 10px;
		}
		#gallery li img {
		  cursor: zoom-in;
		}
		#modal {
		  position: fixed;
		  z-index: 10;
		  top: 0;
		  left: 0;
		  bottom: 0;
		  right: 0;
		  width: 70%;
		  height: 70%;
		  margin: auto;
		  display: none;
		}
		#modal img {
			cursor: zoom-out;
		}
		#veil {			
  			position: fixed;
  			top: 0;
  			left: 0;
  			width: 100%;
  			height: 100%;
  			background-color: #000;
  			opacity: 80%;
  			display: none;
		}
	</style>
	<script>

		function showImg(img) {
			document.getElementById('modal_img').src = img.src;
			document.getElementById('modal').style.display = "block";
			document.getElementById('veil').style.display = "block";
		}
		function hideImg() {
			document.getElementById('modal').style.display = "none";
			document.getElementById('veil').style.display = "none";
		}
	</script>
</head>
<body>

	<h1>Галерея</h1>
	
	<ul id="gallery">
		<?php
			foreach($gallery as $item) {
				if (in_array(substr($item, -3), array('jpg', 'png'))) {
					$url = $dirname . '/' .$item;
					echo '<li><a href="#"><img onclick="showImg(this)" src="'. $url .'" width="150" /></a>';
				}
			}
		?>
	</ul>
	<div id="modal">
		<img width=700 id="modal_img" src="#" onclick="hideImg()">
	</div>
	<div id="veil"></div>

	<form enctype="multipart/form-data" method="POST" action="lesson4_1.php">
	   <p>Загрузить фотографию</p>
	   <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
	   <p><input type="file" name="img" multiple accept="image/*,image/jpeg">
	   <input type="submit" value="Отправить"></p>
  	</form>
</body>
</html>