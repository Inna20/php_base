<?php
function indexAction()
{
    isAdmin();
    return 'Все заказы';

}

function addAction()
{
    $user_name = clearStr($_POST['user_name']);
    $adress = clearStr($_POST['adress']);
    $price = 456;
    $tel = clearStr($_POST['tel']);
    $order_data = json_encode($_SESSION['goods'], JSON_UNESCAPED_UNICODE );

    $sql = "
        INSERT INTO 
            orders(user_name, adress, price, tel, order_data) 
            VALUES
            ('$user_name', '$adress', '$price', '$tel', '$order_data')
	";

    mysqli_query(getConnect(), $sql);

    unset($_SESSION['goods']);
    $_SESSION['msg'] = 'Заказ добавлен';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

