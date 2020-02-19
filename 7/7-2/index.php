<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'massage';

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
    Therapists Shifts
    <table border="1">
        <tr>
            <th>
                therapist_id
            </th>
            <th>
                target_date
            </th>
            <th>
                start_time
            </th>
            <th>
                end_time
            </th>
            <th>
                sort_start_time
            </th>
        </tr>
        <?php
        $result = $conn->query(
            'SELECT
                `therapist_id`,
                `target_date`,
                `start_time`,
                `end_time`,
            CASE
                WHEN `start_time` <= "05:59:59" AND `start_time` >= "00:00:00" THEN CONCAT(DATE_ADD(`target_date`, INTERVAL 1 DAY), " ", `start_time`)
                ELSE CONCAT(`target_date`, " ", `start_time`)
            END AS `sort_start_time`
            FROM `daily_work_shifts`
            ORDER BY
                `target_date`,
                `sort_start_time`;'
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