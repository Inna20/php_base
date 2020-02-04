<?php 
    include('bd.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
</head>
<body>

    <?php 
        $res = mysqli_query($link, "SELECT img_min, id FROM img ORDER BY count DESC");
        while($row = mysqli_fetch_assoc($res)){
            $imgMin = $row['img_min'];
            $id = $row['id'];
            echo "<a href='openImg.php?id=$id' target='_blank'><img src=images/min/$imgMin></a>";
        }
    ?>
</body>
</html>