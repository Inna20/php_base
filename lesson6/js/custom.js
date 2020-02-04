function calc(button) {
	document.getElementById('operator').setAttribute("value", button.name);
	document.getElementById('form2').submit();
}