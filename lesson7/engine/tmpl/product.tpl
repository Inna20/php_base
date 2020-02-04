<h1>Страница товара</h1>

{CONTENT}

{REVIEW}

<h3>Оставить отзыв</h3>

<form action="?page=7&id={PRODUCT_ID}" method="post">
	<label for="nameReview">Имя</label>
	<input type="text" name="nameReview">
	<br>
	<label for="textReview">Текст</label>
	<textarea name="textReview"></textarea>
	<input type="submit" value="Отправить"/>
</form>