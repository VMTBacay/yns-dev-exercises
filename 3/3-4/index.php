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
    1) Retrieve employees whose last name start with "K".<br>
    <table>
        <?php
        $sql = 'SELECT * FROM `employees` WHERE `last_name` LIKE "K%";';
        $result = $conn->query($sql);
        foreach ($result as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '<td>';
            }
            echo '</tr>';
        }
        ?>
    </table><br><br><br>
    2) Retrieve employees whose last name end with "i".<br>
    <table>
       <?php
        $sql = 'SELECT * FROM `employees` WHERE `last_name` LIKE "%i";';
        $result = $conn->query($sql);
        foreach ($result as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '<td>';
            }
            echo '</tr>';
        }
        ?>
    </table><br><br><br>
    3) Retrieve employee's full name and their hire date whose hire date is between 2015/1/1 and 2015/3/31 ordered by ascending by hire date. (Hint. Use CONCAT)<br>
    <table>
       <?php
        $sql = 'SELECT concat(`first_name`, " ", `middle_name`, " ", `last_name`) AS `full_name` , `hire_date`  FROM `employees` WHERE `hire_date` BETWEEN "2015-01-01" AND "2015-03-31" ORDER BY `hire_date` ASC;';
        $result = $conn->query($sql);
        foreach ($result as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '<td>';
            }
            echo '</tr>';
        }
        ?>
    </table><br><br><br>
    4) Retrieve employee's last name and their boss's last name. If they don't have boss, no need to retrieve and show.<br>
    <table>
       <?php
        $sql = 'SELECT `e1`.`last_name` AS `Employee`, `e2`.`last_name` AS `Boss` FROM `employees` AS `e1`, `employees` AS `e2` WHERE `e1`.`boss_id` = `e2`.`id`;';
        $result = $conn->query($sql);
        foreach ($result as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '<td>';
            }
            echo '</tr>';
        }
        ?>
    </table><br><br><br>
    5) Retrieve employee's last name who belong to Sales department ordered by descending by last name.<br>
    <table>
       <?php
        $sql = 'SELECT `last_name` FROM `employees` WHERE `department_id` = 3 ORDER BY `last_name` DESC;';
        $result = $conn->query($sql);
        foreach ($result as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '<td>';
            }
            echo '</tr>';
        }
        ?>
    </table><br><br><br>
    6) Retrieve number of employee who has middle name.<br>
    <table>
       <?php
        $sql = 'SELECT COUNT(`middle_name`) AS `count_has_middle` FROM `employees`;';
        $result = $conn->query($sql);
        foreach ($result as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '<td>';
            }
            echo '</tr>';
        }
        ?>
    </table><br><br><br>
    7) Retrieve department name and number of employee in each department. You don't need to retrieve the department name which doesn't have employee.<br>
    <table>
       <?php
        $sql = 'SELECT `d`.`name`, (SELECT COUNT(*) FROM `employees` WHERE `d`.`id` = `employees`.`department_id`) AS `department_count` FROM `departments` AS `d` WHERE NOT (SELECT COUNT(*) FROM `employees` WHERE `d`.`id` = `employees`.`department_id`) = 0;';
        $result = $conn->query($sql);
        foreach ($result as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '<td>';
            }
            echo '</tr>';
        }
        ?>
    </table><br><br><br>
    8) Retrieve employee's full name and hire date who was hired the most recently.<br>
    <table>
       <?php
        $sql = 'SELECT `first_name`, `middle_name`, `last_name`, `hire_date`  FROM `employees` ORDER BY `hire_date` DESC LIMIT 1;';
        $result = $conn->query($sql);
        foreach ($result as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '<td>';
            }
            echo '</tr>';
        }
        ?>
    </table><br><br><br>
    9) Retrieve department name which has no employee.<br>
    <table>
       <?php
        $sql = 'SELECT `d`.`name`, (SELECT COUNT(*) FROM `employees` WHERE `d`.`id` = `employees`.`department_id`) AS `department_count` FROM `departments` AS `d` WHERE (SELECT COUNT(*) FROM `employees` WHERE `d`.`id` = `employees`.`department_id`) = 0;';
        $result = $conn->query($sql);
        foreach ($result as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '<td>';
            }
            echo '</tr>';
        }
        ?>
    </table><br><br><br>
    10) Retrieve employee's full name who has more than 2 positions<br>
    <table>
       <?php
        $sql = 'SELECT `e`.`first_name`, `e`.`middle_name`, `e`.`last_name` FROM `employees` AS `e` WHERE (SELECT COUNT(*) FROM `employee_positions` AS `ep` WHERE `e`.`id` =  `ep`.`employee_id`) > 1;';
        $result = $conn->query($sql);
        foreach ($result as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '<td>';
            }
            echo '</tr>';
        }
        ?>
    </table><br><br><br>
</body>
</html>