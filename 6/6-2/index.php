<!DOCTYPE html>
<html>
<head>
    <title>6-2</title>
</head>
<body>
    Pentagonal Number<br>
    <?php
    /*
    QUESTION:

    Have the function pentagonalNumber(num) read num which will be a positive integer and determine how many dots exist in a pentagonal shape around a center dot on the Nth iteration. For example, in the image below you can see that on the first iteration there is only a single dot, on the second iteration there are 6 dots, on the third there are 16 dots, and on the fourth there are 31 dots.

    ===============================================================================

    Input:2

    Output:6



    Input:3

    Output:16
    */
    echo 'pentagonalNumber(2): ' . pentagonalNumber(2);
    echo '<br>';
    echo 'pentagonalNumber(3): ' . pentagonalNumber(3);

    function pentagonalNumber(int $num): int {
        return 1 + 5 * ($num * ($num - 1) / 2);
    }
    ?>
</body>
</html>