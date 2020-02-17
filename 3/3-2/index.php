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
    if ($conn->query('CREATE TABLE `sample`.`testing` ( `id` INT NOT NULL , `name` TEXT NOT NULL , `number` INT NOT NULL ) ENGINE = InnoDB;') === TRUE) {
        echo 'Table Successfully created';
    } else {
        echo $conn->error;
    }
    ?>
</body>
</html>

