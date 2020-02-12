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
        for ($k = 0; $k < count($user); $k++) { 
            echo "<td>" . $user[$k] . "</td>";
        }
    }
}
echo "</table>";
fclose($handle);
?>
</body>
</html>