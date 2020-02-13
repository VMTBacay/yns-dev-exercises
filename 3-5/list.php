<?php
session_start();
include "connect.php";
?>
<html>
<body>
<?php
if (isset($_SESSION["user"])) {
    echo "You are currently logged in as " . $_SESSION["user"] . " <form action='index.php' method='post'><input type='submit' value='Sign out' name='signout'></form><br><br>";
}

$result = $conn->query("SELECT * FROM users");
$usercount = $result->num_rows;

$limit = 10;

$pages = ceil($usercount / $limit);

$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
    'options' => array(
        'default'   => 1,
        'min_range' => 1,
    ),
)));

$offset = ($page - 1)  * $limit;

$start = $offset + 1;
$end = min(($offset + $limit), $usercount);

$prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

$nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $usercount, ' results ', $nextlink, ' </p></div>';

echo "Users<br><table border=1>";

$result = $conn->query("SELECT * FROM users LIMIT $limit OFFSET $offset");

foreach ($result as $row) { 
    echo "<tr>";
    foreach ($row as $key => $value) { 
        if ($key === "profile_pic") {
            echo "<td><img src='images/" . $value . "'></td></tr>";
        } else  { 
            echo "<td>" . $value . "</td>";
        }
    }
    
    
}
echo "</table>";
$conn->close();
?>
</body>
</html>