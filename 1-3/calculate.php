<!DOCTYPE html>
<html>
<head>
    <title>1-3</title>
</head>
<body>
    <?php
    function gcd(int $a, int $b): int {
        return ($a % $b) ? gcd($b,$a % $b) : $b;
    }

    echo 'The result is ' . gcd($_POST['num1'], $_POST['num2']);
    ?>
</body>
</html>