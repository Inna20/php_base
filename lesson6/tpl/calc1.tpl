<h1>Калькулятор 1</h1>
	{RESULT}
	<form action="?page=4&referer_page={REFERER_PAGE}" method="post">
		<label for="number1">Первое число</label>
		<input type="number" pattern="^[0-9]+$"  name="number1">
		<label for="operetor">Операция</label>
		<select name="operator">
			<option value="sum">Сложение</option>
			<option value="subtract">Вычитание</option>
			<option value="multipl">Умножение</option>
			<option value="division">Деление</option>
		</select>
		<label for="number2">Второе число</label>
		<input type="number" pattern="^[0-9]+$" name="number2">
		<input type="submit" value="Посчитать"/>
	</form>