<!DOCTYPE html>
<html>
<head>
    <title>5-2</title>
</head>
<body>
Calendar
    <table border="1">
        <?php
        $month = filter_input(INPUT_GET, 'month', FILTER_VALIDATE_INT, array('options' => array('default' => 0)));
        $current = explode('-', date('Y-m-F-d-w-D', strtotime('+' . $month . ' month')));
        $total_days = cal_days_in_month(CAL_GREGORIAN, $current[1], $current[0]);
        $day = 1;
        $offset = 0;
        $first_day = (((intval($current[4]) - intval($current[3]) + 1) % 7) + 7) % 7;
        $days_of_week = array( 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
        echo '<tr><th><a href="?month=' . ($month - 1) . '">&lsaquo;</a></th><th colspan=5>' . $current[2] . ' ' . $current[0] . '</th><th><a href="?month=' . ($month + 1) . '">&rsaquo;</a></th></tr>';
        echo '<tr>';
        foreach ($days_of_week as $d) {
            echo '<td>' . $d . '</td>';
        }
        echo '</tr>';
        while (true) {
            echo '<tr>';
            for ($i = 0; $i < 7; $i++) {
                if ($offset < $first_day) {
                    echo '<td></td>';
                    $offset++;
                    continue;
                }
                if ($day > $total_days) {
                    break 2;
                } elseif ($day === intval($current[3]) && $month === 0) {
                    echo '<td bgcolor="lightblue">' . $day . '</td>';
                } else {
                    echo '<td>' . $day . '</td>';
                }
                $day++;
            }
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>