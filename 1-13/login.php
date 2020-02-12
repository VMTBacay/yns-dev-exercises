<?php
if (isset($_POST["login"])) {
	if (strpos(file_get_contents("users.csv"), $_POST["user"].",".$_POST["pass"]) !== false) {
	    session_start();
	    $_SESSION["user"] = $_POST["user"];
	    header("location: index.php");
	} else {
		echo "Invalid Credentials";
	}
}
?>
<html>
<body>
<form action="login.php" method="post">
	Username: <input type="text" name="user"><br>
	Password: <input type="password" name="pass"><br>
	<input type="submit" value="Log in" name="login">
</form>
</body>
</html>