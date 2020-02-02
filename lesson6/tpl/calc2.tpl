<h1>Калькулятор 2</h1>
	{RESULT}
	<form action="?page=4&referer_page={REFERER_PAGE}" method="post" id="form2">
		<input type="hidden" id="operator" name="operator" value="">
		<label for="number1">Первое число</label>
		<input type="number" pattern="^[0-9]+$"  name="number1">
		<label for="number2">Второе число</label>
		<input type="number" pattern="^[0-9]+$" name="number2">
	
		<input type="button" name="sum" value="+"      onclick="calc(this)">
		<input type="button" name="subtract" value="-" onclick="calc(this)">
		<input type="button" name="multipl" value="*"  onclick="calc(this)">
		<input type="button" name="division" value="/" onclick="calc(this)">
	</form>
