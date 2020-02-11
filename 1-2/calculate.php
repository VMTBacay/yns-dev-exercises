<html>
<body>

<?php
if (isset($_POST["add"])) {
	echo $_POST["num1"] + $_POST["num2"];
} elseif (isset($_POST["sub"])) {
	echo $_POST["num1"] - $_POST["num2"];
} elseif (isset($_POST["mul"])) {
	echo $_POST["num1"] * $_POST["num2"];
} else {
	echo $_POST["num1"] / $_POST["num2"];
}
?>

</body>
</html> 