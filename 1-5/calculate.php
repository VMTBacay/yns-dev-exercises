<html>
<body>
<?php
echo "3 days from that date is " . date('m-d-Y-D', strtotime("+3 Days", strtotime($_POST['date'])));
?>
</body>
</html>