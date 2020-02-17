<?php
session_start();
if (isset($_POST['signout'])) {
    session_unset();
}
?>
<html>
<body>
<?php
if (isset($_SESSION['user'])) {
    echo 'You are currently logged in as ' . $_SESSION['user'] . ' <form action="index.php" method="post"><input type="submit" value="Sign out" name="signout"></form><br><br>';
} else {
    ?>
    <form action="display.php" method="post" enctype="multipart/form-data">
        Username: <input type="text" name="user"><br>
        Password: <input type="password" name="pass"><br>
        Email Address: <input type="text" name="email"><br>
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload"><br>
        <input type="submit" value="Submit" name="submit">
    </form>
    <a href="login.php">Log In</a><br>
    <?php
}
?>
<a href="list.php">Show users</a>
</body>
</html>