<html>
<body>
<?php
if (($file = fopen("users.csv", "r")) !== FALSE) {
	echo "<table border=1>";
	echo "<tr><td>Name</td><td>Contact No.</td><td>Email Address</td></tr>";
    while (($data = fgetcsv($file)) !== FALSE) {
        echo "<tr>";
        for ($i = 0; $i < count($data); $i++) {
            echo "<td>" . $data[$i] . "</td>";
        }
        echo "</tr>";
    }
    fclose($file);
    echo "</table>";
}
?>
</body>
</html>