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
    <title>7-4</title>
</head>
<body>
    <table border="1">
        <?php
        $result = $conn->query('SELECT * FROM `parents` WHERE id IS NOT NULL ORDER BY CASE WHEN `parent_id` IS NULL then `id` ELSE `parent_id` END');
        foreach ($result as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                    if ($value === null) {
                        echo '<td>null</td>';
                    } else {
                        echo '<td>' . $value . '</td>';
                    }
            }
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>