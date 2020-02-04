<?php

function indexAction()
{
    return getProducts();
}

function oneAction()
{
    if (empty($_GET['id'])) {
        header('location: ?p=product');
        exit;
    }
    $id = (int)$_GET['id'];
    incrementProduct_view($id);
    $content = getProduct($id);

    // Если есть отзывы
    $reviews = getRewiews($id);

    $tmpl = file_get_contents(dirname(__DIR__) . '/tmpl/item.tpl');
    return str_replace(array('{PRODUCT_ID}', '{CONTENT}', '{REVIEW}'), array($id, $content, $reviews), $tmpl);
}


function getProducts() {

    $sql = <<<sql
        select * from products 
        order by views DESC
sql;
    $products = mysqli_query(getConnect(), $sql);

    $content = '<ul id="gallery">';
    while($res = mysqli_fetch_assoc($products)) {
        
        $content .= <<<sql
                        <li><a href="?p=product&a=one&id={$res['id']}">
                            <img src="{$res['url']}" width="150" />
                            <h4>{$res['name']}</h4>
                            </a>
                            <a href="?p=cart&a=add&id={$res['id']}">Купить</a>
                        </li>
sql;
    }
    $content .= '</ul>';

    return $content;
}

function getProduct($id) {

    $sql = <<<sql
        select * from products
        where id = $id
sql;
    $product = mysqli_query(getConnect(), $sql);

    $item = mysqli_fetch_assoc($product);

    if (!$item) {
        header('Location: ?p=product');
        exit;
    }

    return <<<html
    <h1>{$item['name']}</h1>
    <img src="{$item['url']}" width="450"/>
    <p>Количество просмотров: {$item['views']}</p>

    <p><a href="?p=cart&a=add&id={$item['id']}">Купить</a></p>

html;
}

function incrementProduct_view($id) {

    $sqlUpdate = <<<sql
                update products
                set views = views+1
                where id = $id
sql;
    mysqli_query(getConnect(), $sqlUpdate);
}

function getRewiews($id) {

    $sql = <<<sql
        select * from product_review
        where product_id = $id
        order by id DESC
sql;
    $rewievs = mysqli_query(getConnect(), $sql);

    $content = '';
    if (mysqli_num_rows($rewievs)) {
        $content = '<h3>Отзывы</h3>';
        $content .= '<ul id="rewiews">';
        while($res = mysqli_fetch_assoc($rewievs)) {
            
            $content .= '<li><p><strong>'.$res['author'].'</strong></p>
                        <p>'.$res['comment'].'</p></li>';
        }
        $content .= '</ul>';
    }

    return $content;

}