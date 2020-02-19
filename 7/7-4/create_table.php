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
    <title>7-2</title>
</head>
<body>
    <?php
    $conn->query('CREATE TABLE `sample`.`parents` ( `id` INT NULL , `parent_id` INT NULL ) ENGINE = InnoDB;');
    $conn->query('INSERT INTO `parents` (`id`, `parent_id`) VALUES ("1", NULL), ("2", "5"), ("3", NULL), ("4", "1"), ("5", NULL), ("6", "3"), ("7", "3"), (NULL, NULL);');
    echo 'Tables successfully created and rows successfully inserted<br>';
    ?>
</body>
</html>