<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <?php
    $result = 0;
    if (isset($_POST['add'])) {
        $result = $_POST['num1'] + $_POST['num2'];
    } elseif (isset($_POST['sub'])) {
        $result = $_POST['num1'] - $_POST['num2'];
    } elseif (isset($_POST['mul'])) {
        $result = $_POST['num1'] * $_POST['num2'];
    } else {
        $result = $_POST['num1'] / $_POST['num2'];
    }
    echo 'The result is ' . $result;
    ?>
</body>
</html>