<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'company';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>3-4</title>
</head>
<body>
    <?php
    $sqls = explode(';', file_get_contents('create_tables.sql'));
    foreach ($sqls as $sql) {
        if ($conn->query($sql) === TRUE) {
            echo 'Query Successfully executed<br>';
        } else {
            echo $conn->error;
        }
    }
    ?>
</body>
</html>