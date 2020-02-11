<html>
<body>

<?php
function gcd($a, $b) {
    return ($a % $b) ? gcd($b,$a % $b) : $b;
}

echo "The result is " . gcd($_POST["num1"], $_POST["num2"]);
?>

</body>
</html> 