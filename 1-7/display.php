<html>
<body>

<?php
preg_match("/\w+@[a-zA-Z]+\.[a-zA-Z]+/", $_POST["email"], $matches);
if (count($matches) != 1) {
	echo "Email Error";
} else {
	echo "Your name is " . $_POST["name"] . "<br>";
	echo "Your contact no. is " . $_POST["cont_num"] . "<br>";
	echo "And your email address is " . $_POST["email"]; 
}
?>

</body>
</html>