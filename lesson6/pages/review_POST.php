<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ?page=5');
    exit;
}

$nameReview = clearStr($_POST['nameReview']);
$textReview = clearStr($_POST['textReview']);

$id = $_GET['id'];

$sql = "
        INSERT INTO product_review 
            (product_id, author, comment) 
        VALUES 
               ($id, '$nameReview', '$textReview')
               ";
$res = mysqli_query($link, $sql);

$location = $id ? '?page=6&id='.$id : '?page=5';
header('Location: '.$location);
exit;

?>