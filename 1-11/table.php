<html>
<body>
<?php
if (($file = fopen("users.csv", "r")) !== FALSE) {
    echo "Users";
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

echo "<br><br><br>";

echo "Uploaded Images <br><table border=1>";
foreach (new DirectoryIterator("images") as $file) {
    if (!$file->isDot()) {
        echo "<tr><td>" . $file . "</td><td><img src='images/" . $file . "'' <br/>";
    }
}
echo "</table>";
?>
</body>
</html>