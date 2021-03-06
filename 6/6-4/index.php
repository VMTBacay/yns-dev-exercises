<!DOCTYPE html>
<html>
<head>
    <title>6-4</title>
</head>
<body>
    Eight Queens<br>
    <?php
    /*
    QUESTION:

    Read strArr which will be an array consisting of the locations of eight Queens on a standard 8x8 chess board with no other pieces on the board. The structure of strArr will be the following: ['(x,y)', '(x,y)', ...] where (x,y) represents the position of the current queen on the chessboard (x and y will both range from 1 to 8 where 1,1 is the bottom-left of the chessboard and 8,8 is the top-right). Your program should determine if all of the queens are placed in such a way where none of them are attacking each other. If this is true for the given input, return the string true otherwise return the first queen in the list that is attacking another piece in the same format it was provided.

    ===============================================================================

    Input:['(1,1)', '(2,2)', '(3,3)', '(4,4)', '(5,5)', '(6,6)', '(7,7)', '(8,8)']

    Output:'(1-1)'



    Input:['(1,5)', '(2,3)', '(3,1)', '(4,7)', '(5,2)', '(6,8)', '(7,6)', '(8,4)']

    Output:'true'
    */
    echo 'eightQueens(array("(8,1)", "(7,2)", "(6,3)", "(5,4)", "(4,5)", "(3,6)", "(2,7)", "(1,8)")): ' . eightQueens(array('(8,1)', '(7,2)', '(6,3)', '(5,4)', '(4,5)', '(3,6)', '(2,7)', '(1,8)'));
    echo '<br>';
    echo 'eightQueens(array("(1,5)", "(2,3)", "(3,1)", "(4,7)", "(5,2)", "(6,8)", "(7,6)", "(8,4)")): ' . eightQueens(array('(1,5)', '(2,3)', '(3,1)', '(4,7)', '(5,2)', '(6,8)', '(7,6)', '(8,4)'));

    function eightQueens(array $strArr): string {
        $occupied_cols = $occupied_rows = $occupied_fdias = $occupied_bdias = array();
        foreach ($strArr as $queen) {
            $c = array_search($queen[1], $occupied_cols);
            if ($c !== false) {
                return $strArr[$c];
            }
            $r = array_search($queen[3], $occupied_rows);
            if ($r !== false) {
                return $strArr[$r];
            }
            $fd = array_search(intval($queen[1]) - intval($queen[3]), $occupied_fdias);
            if ($fd !== false) {
                return $strArr[$fd];
            }
            $bd = array_search(intval($queen[1]) + intval($queen[3]), $occupied_bdias);
            if ($bd !== false) {
                return $strArr[$bd];
            }
            array_push($occupied_cols, $queen[1]);
            array_push($occupied_rows, $queen[3]);
            array_push($occupied_fdias, intval($queen[1]) - intval($queen[3]));
            array_push($occupied_bdias, intval($queen[1]) + intval($queen[3]));
        }
        return 'true';
    }
    ?>
</body>
</html>