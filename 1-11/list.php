<html>
<body>
<?php

$handle = fopen("users.csv", "r");
echo "Users<br><table border=1>";


while (TRUE) { 
    $user = explode(",", fgets($handle));
    if (count($user) === 1) {
        break;
    } else {
        echo "<tr>";
        for ($k = 0; $k < count($user) - 1; $k++) { 
            echo "<td>" . $user[$k] . "</td>";
        }
        echo "<td><img src='images/" . $user[$k] . "'></td></tr>";
    }
}
echo "</table>";
fclose($handle);
?>
</body>
</html>