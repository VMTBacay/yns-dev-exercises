<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'sample';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>3-2</title>
</head>
<body>
    <?php
    if ($conn->query('INSERT INTO `testing` (`id`, `name`, `number`) VALUES (1, "Hello, World!", 42);') === TRUE) {
        echo 'Row Successfully inserted<br>';
    } else {
        echo $conn->error;
    }
    if ($conn->query('UPDATE `testing` SET `name` = "Hello, 世界!" WHERE `id` = 1;') === TRUE) {
        echo 'Row Successfully updated<br>';
    } else {
        echo $conn->error;
    }
    if ($conn->query('DELETE FROM `testing` WHERE `id` = 1') === TRUE) {
        echo 'Row Successfully deleted<br>';
    } else {
        echo $conn->error;
    }
    ?>
</body>
</html>