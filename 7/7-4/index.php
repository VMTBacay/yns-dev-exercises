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
        $result = $conn->query(
            'SELECT 
            CASE
                WHEN `id` = 1 THEN 1
                WHEN `id` = 2 THEN 4
                WHEN `id` = 3 THEN 3
                WHEN `id` = 4 THEN 6
                WHEN `id` = 5 THEN 7
                WHEN `id` = 6 THEN 2
                WHEN `id` = 7 THEN 5
            END,
            CASE
                WHEN `id` = 1 THEN NULL
                WHEN `id` = 2 THEN 1
                WHEN `id` = 3 THEN NULL
                WHEN `id` = 4 THEN 3
                WHEN `id` = 5 THEN 3
                WHEN `id` = 6 THEN 5
                WHEN `id` = 7 THEN NULL
            END
            FROM `parents` 
            WHERE id IS NOT NULL'
        );
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