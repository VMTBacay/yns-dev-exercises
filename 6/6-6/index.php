<!DOCTYPE html>
<html>
<head>
    <title>6-6</title>
</head>
<body>
    Maximal Square<br>
    <?php
    /*
    QUESTION:

    Have the function maximalSquare(strArr) take the strArr parameter being passed which will be a 2D matrix of 0 and 1's, and determine the area of the largest square submatrix that contains all 1's. A square submatrix is one of equal width and height, and your program should return the area of the largest submatrix that contains only 1's. For example: if strArr is ['10100', '10111', '11111', '10010'] then this looks like the following matrix:



    1 0 1 0 0

    1 0 1 1 1

    1 1 1 1 1

    1 0 0 1 0



    For the input above, you can see the bolded 1's create the largest square submatrix of size 2x2, so your program should return the area which is 4. You can assume the input will not be empty.

    ===============================================================================

    Input:['10100', '10111', '11111', '10010']

    Output:4



    Input:['101111', '101111', '111111', '101111', '111011']

    Output:'not found'
    */
    echo 'maximalSquare(array("10100", "10111", "11111", "10010")): ' . maximalSquare(array('10100', '10111', '11111', '10010'));
    echo '<br>';
    echo 'maximalSquare(array("101111", "101111", "111111", "101111", "111011")): ' . maximalSquare(array('101111', '101111', '111111', '101111', '111011'));

    function maximalSquare(array $strArr): int {
        $len = count($strArr);
        $wid = strlen($strArr[0]);
        $side = 0;
        for ($i = 0; $i < $len - $side + 1; $i++) {
            for ($j = 0; $j < $wid - $side + 1; $j++) {
                for ($k = 0; $k < $side + 1 && $i + $k < $len; $k++) {
                    for ($l = 0; $l < $side + 1 && $j + $l < $wid; $l++) {
                        if ($strArr[$i + $k][$j + $l] !== '1') {
                            continue 3;
                        }
                    }
                    if ($k === $side) {
                        $side++;
                    }
                }
            }
        }
        return $side * $side;
    }
    ?>
</body>
</html>