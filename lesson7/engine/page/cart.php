<?php

function indexAction() {

	if (empty($_SESSION['goods'])) {
		$content = "Корзина пуста";

	} else {
		$content = getCart();
	}

    $tmpl = file_get_contents(dirname(__DIR__) . '/tmpl/cart.tpl');
    return str_replace('{CONTENT}', $content, $tmpl);
}

function addAction() {

	if (empty($_GET['id'])) {
		redirect("cart", "Такого товара не существует");
    }
    $id = (int)$_GET['id'];

    $product = getCartProduct($id);
    addToCart($product);

    // обратно в корзину
    redirect("cart", "Товар \"".$product['name']."\" добавлен в корзину");

}

function delAction() {

	if (!empty($_GET['id'])) {
		$id = (int)$_GET['id'];

    	removeFromCart($id);
    }
  
    // обратно в корзину
    redirect("cart", "");

}

function getCart() {
	$content = "<ul>";
    foreach ($_SESSION['goods'] as $id => $cartProduct) {
    	$price = (int)$cartProduct['price']*(int)$cartProduct['count'];
    	$content .= <<<html
					<li>
						{$cartProduct['name']}, количество: {$cartProduct['count']}, цена: {$price} 
						<a href="?p=cart&a=add&id={$id}">Добавить еще</a>,
						<a href="?p=cart&a=del&id={$id}">Удалить</a>
					</li>
html;
    }
    $content .= "</ul>";

    return $content;
}

function addToCart($product) {
	if (!empty($_SESSION['goods'][$product['id']])) {
		$_SESSION['goods'][$product['id']]['count']++;
	} else {
		$_SESSION['goods'][$product['id']] = $product;
		$_SESSION['goods'][$product['id']]['count'] = 1;
	}
}

function removeFromCart($id){
	if (empty($_SESSION['goods'][$id])) {
		return false;
	}

	if ($_SESSION['goods'][$id]['count'] > 1) {
		$_SESSION['goods'][$id]['count']--;

	} else {
		unset($_SESSION['goods'][$id]);
	}
}

function getCartProduct($id) {
	$sql = <<<sql
        select id, name, price from products
        where id = $id
sql;
    $product = mysqli_query(getConnect(), $sql);

    $item = mysqli_fetch_assoc($product);

    if (!$item) {
        redirect("cart", "Такого товара не существует");
    }

    return $item;
}