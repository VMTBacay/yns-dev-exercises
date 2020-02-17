<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>1-13</title>
</head>
<body>
    <?php
    if (isset($_SESSION['user'])) {
        echo 'You are currently logged in as ' . $_SESSION['user'] . ' <form action="index.php" method="post"><input type="submit" value="Sign out" name="signout"></form><br><br>';
    }
    $usercount = -1;
    $handle = fopen('users.csv', 'r');
    while(!feof($handle)){
      fgets($handle);
      $usercount++;
    }
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

    rewind($handle);
    echo 'Users<br><table border=1>';
    for ($i = 0; $i < $offset; $i++) {
        fgets($handle);
    }
    for ($i=0; $i < $limit; $i++) {
        $user = explode(',', fgets($handle));
        if (count($user) === 1) {
            break;
        } else {

            echo '<tr>';
            for ($k = 0; $k < count($user) - 1; $k++) {
                echo '<td>' . $user[$k] . '</td>';
            }
            echo '<td><img src="images/' . $user[$k] . '"></td></tr>';
        }
    }
    echo '</table>';
    fclose($handle);
    ?>
</body>
</html>