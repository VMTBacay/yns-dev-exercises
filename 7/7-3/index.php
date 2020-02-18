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
    <title>7-3</title>
</head>
<body>
    Employee information with full position name<br><br>
    <table border="1">
        <tr>
            <th>
                id
            </th>
            <th>
                first_name
            </th>
            <th>
                last_name
            </th>
            <th>
                middle_name
            </th>
            <th>
                birth_date
            </th>
            <th>
                department_id
            </th>
            <th>
                hire_date
            </th>
            <th>
                boss_id
            </th>
            <th>
                full_position_name
            </th>
       <?php
        $result = $conn->query(
            'SELECT
                `e`.`id`,
                `first_name`,
                `last_name`,
                `middle_name`,
                `birth_date`,
                `department_id`,
                `hire_date`,
                `boss_id`,
            CASE
                WHEN `p`.`name` = "CEO" THEN "Chief Executive Officer"
                WHEN `p`.`name` = "CTO" THEN "Chief Technical Officer"
                WHEN `p`.`name` = "CFO" THEN "Chief Financial Officer"
                ELSE `p`.`name`
            END
            FROM `employees` AS `e`
            JOIN `employee_positions` AS `ep`
            ON `ep`.`employee_id` = `e`.`id`
            JOIN `positions` as `p`
            ON `p`.`id` = `ep`.`position_id`;'
        );
        foreach ($result as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                    echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>