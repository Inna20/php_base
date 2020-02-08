<?php
function indexAction()
{
   if (empty($_SESSION['user']['id'])) {
        redirect("auth", "Авторизуйтесь, чтобы просматривать заказы");
    }

    $content = getOrders();

    $tmpl = file_get_contents(dirname(__DIR__) . '/tmpl/orders.tpl');
    return str_replace('{CONTENT}', $content, $tmpl);

}

function allAction() {
    if (!isAdmin()) {
        redirect("index", "У вас нет доступа к этой странице");
    }

    $content = getAllOrders();

    $tmpl = file_get_contents(dirname(__DIR__) . '/tmpl/orders.tpl');
    return str_replace('{CONTENT}', $content, $tmpl);
}

function statusAction() {
    if (!isAdmin()) {
        redirect("index", "У вас нет доступа к этой странице");
    }

    if (!$_POST['order_id']) {
        redirect("order", "Нет такого заказа");
    }

    $new_status = (int)$_POST['status'];

    if (!in_array($new_status, array_keys(getOrderStatusArray()))) {
        redirect("order", "Не коррекртый статус");
    }

    if (changeStatus((int)$_POST['order_id'], $new_status)) {
        $msg = "Статус изменен";
    } else {
        $msg = "Заказ не найден";
    }

    redirect("order&a=all", $msg); //TODO добавить параметр action
}

function addAction()
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        redirect("cart", "");
    }

    $user_id = (int)($_POST['user_id']);

    if(!userExists($user_id)) {
        redirect("index", "Пользователь не найден");
    }

    $user_name = clearStr($_POST['user_name']);
    $adress = clearStr($_POST['address']);
    $price = $_SESSION['totalPrice'];
    $tel = clearStr($_POST['phone']);
    $email = clearStr($_POST['email']);
    $order_data = json_encode($_SESSION['goods'], JSON_UNESCAPED_UNICODE );

    $sql = "
        INSERT INTO 
            orders(user_id, user_name, address, price, phone, email, order_data) 
            VALUES
            ($user_id, '$user_name', '$address', $price, '$tel', '$email', '$order_data')
	";

    mysqli_query(getConnect(), $sql);

    unset($_SESSION['goods']);
    unset($_SESSION['totalPrice']);
    $_SESSION['msg'] = 'Заказ добавлен';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

function userExists($user_id){
    $sql = <<<sql
            select count(id) as count
            from users
            where id = $user_id
sql;
    $res = mysqli_query(getConnect(), $sql);

    return (mysqli_fetch_assoc($res)['count'] == 0) ? false : true; 
}

function getOrders() {
    $userId = $_SESSION['user']['id'];

    $sql = <<<sql
            select id, order_data, price
            from orders
            where user_id = $userId
sql;
    $orders = mysqli_query(getConnect(), $sql);

    if (!mysqli_num_rows($orders)) {
        return '<p>У вас пока нет заказов</p>';
    }

    $res = '<h1>Мои заказы</h1>';
    while ($order = mysqli_fetch_assoc($orders)) {
       $res .= '<h3>Заказ '.$order['id'].'</h3>';
       $order_data = json_decode($order['order_data']);
       if ($order_data){
            $res .= '<ul>';
            foreach ($order_data as $item) {
                $res .= <<<ul

                        <li>Наименование: {$item->name}, цена: {$item->price}, количество: {$item->count}</li>

ul;
            }
            
            $res .= '</ul>';
       }
       $res .= 'Общая стоимость: ' . $order['price'];
    }

    return $res;
}

function getAllOrders() {
    $sql = <<<sql
            select id, user_name, order_data, price, status
            from orders
sql;
    $orders = mysqli_query(getConnect(), $sql);

    if (!mysqli_num_rows($orders)) {
        return '<p>Нет заказов</p>';
    }

    $res = '<h1>Все заказы</h1>';
    while ($order = mysqli_fetch_assoc($orders)) {
       $res .= '<h3>Заказ '.$order['id'].'</h3>';
       $res .= '<h4>Пользователь '.$order['user_name'].'</h3>';
       $order_data = json_decode($order['order_data']);
       if ($order_data){
            $res .= '<ul>';
            foreach ($order_data as $item) {
                $res .= <<<ul

                        <li>Наименование: {$item->name}, цена: {$item->price}, количество: {$item->count}</li>

ul;
            }
            
            $res .= '</ul>';
       }
       $res .= '<p>Общая стоимость: ' . $order['price'] . '</p>';

       $statuses = getOrderStatusArray();
                
       // изменение статуса
       $res .= '<form method="post" action="?p=order&a=status">';
       $res .= '<input type="hidden" name="order_id" value="'. $order['id'] .'">';
       $res .= '<select name="status">';
       foreach ($statuses as $key => $status) {
           $res .= '<option value="'.$key.'" '. ($order['status'] == $key ? 'selected' : '') .'>'.$status.'</option>';
       }
       
       $res .= '</select>';
       $res .= '<input type="submit" value="Изменить">';
       $res .= '</form>';

    }

    return $res;
}

function changeStatus($order_id, $status) {
    $sql = "
        UPDATE orders
        SET status = $status
        WHERE id = $order_id
    ";

    return mysqli_query(getConnect(), $sql);
}
