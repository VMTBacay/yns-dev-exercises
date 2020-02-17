<?php
include 'connect.php';

if (isset($_POST['login'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['user'] = $username;
        $conn->close();
        header('location: index.php');
    } else {
        echo 'Invalid Credentials';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>3-5</title>
</head>
<body>
    <form action="login.php" method="post">
        Username: <input type="text" name="user"><br>
        Password: <input type="password" name="pass"><br>
        <input type="submit" value="Log in" name="login">
    </form>
</body>
</html>