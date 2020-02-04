<?php 
    include('bd.php');
	$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
	$res = mysqli_query($link, "SELECT img_max FROM img WHERE id = '$id'");
	$row = mysqli_fetch_assoc($res);
	if (empty($row)){
		header('Location: index.php');
		exit;
	}
	mysqli_query($link, "UPDATE img SET count = count + 1 WHERE img.id = $id");
	$src = $row['img_max'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Голерея</title>
    <style>
        div {
            display: flex;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div>
    <?php 
       echo "<img src=". DIR_IMG. "/max/$src>"
    ?>
    </div>

</body>
</html>