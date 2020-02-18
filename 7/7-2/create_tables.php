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
    <?php
    $conn->query('CREATE TABLE `massage`.`therapists` ( `id` INT NOT NULL AUTO_INCREMENT, `name` VARCHAR(100) NOT NULL, PRIMARY KEY (`id`)) ENGINE = InnoDB;');
    $conn->query('CREATE TABLE `massage`.`daily_work_shifts` ( `id` INT NOT NULL AUTO_INCREMENT , `therapist_id` INT NOT NULL , `target_date` DATE NOT NULL , `start_time` TIME NOT NULL , `end_time` TIME NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;');
    $conn->query('INSERT INTO `therapists` (`id`, `name`) VALUES (1, "John"), (NULL, "Arnold"), (NULL, "Robert"), (NULL, "Ervin"), (NULL, "Smith");');
    $conn->query(
        'INSERT INTO `daily_work_shifts` (`id`, `therapist_id`, `target_date`, `start_time`, `end_time`)
        VALUES
            (1, 1, CURDATE(), '14:00:00', '15:00:00'),
            (NULL, 2, CURDATE(), '22:00:00', '23:00:00'),
            (NULL, 3, CURDATE(), '00:00:00', '01:00:00'),
            (NULL, 4, CURDATE(), '05:00:00', '05:30:00'),
            (NULL, 1, CURDATE(), '21:00:00', '21:45:00'),
            (NULL, 5, CURDATE(), '05:30:00', '05:50:00'),
            (NULL, 3, CURDATE(), '02:00:00', '02:30:00');'
    );
    echo 'Tables successfully created and rows successfully inserted<br>';
    ?>
</body>
</html>