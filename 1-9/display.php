<html>
<body>

<?php

preg_match("/\w+@[a-zA-Z]+\.[a-zA-Z]+/", $_POST["email"], $matches);
if (count($matches) != 1) {
	echo "Email Error";
} else {
		$fields = array($_POST["name"], $_POST["cont_num"], $_POST["email"]);
		echo "Your name is " . $fields[0] . "<br>";
		echo "Your contact no. is " . $fields[1] . "<br>";
		echo "Your email address is " . $fields[2] . "<br>"; 
		$file = fopen("users.csv", "a");
		fputcsv($file, $fields);
		fclose($file);
	}
}


?>

</body>
</html>