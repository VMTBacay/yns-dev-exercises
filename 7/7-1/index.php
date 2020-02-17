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
    <title>7-1</title>
</head>
<body>
    Employees older than 30 but younger than 40<br><br>
    <table border="1">
       <?php
        $columns = $conn->query('SHOW columns FROM employees;');
        echo '<tr>';
        while ($column = mysqli_fetch_array($columns)) {
            echo '<td>' . $column[0] . '<td>';
        }
        echo '</tr>';
        $result = $conn->query('SELECT * FROM employees WHERE 1261440000 > TIMESTAMPDIFF(SECOND, birth_date, CURRENT_DATE) AND TIMESTAMPDIFF(SECOND, birth_date, CURRENT_DATE) > 946080000');
        foreach ($result as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '<td>';
            }
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>