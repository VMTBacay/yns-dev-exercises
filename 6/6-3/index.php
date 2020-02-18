<!DOCTYPE html>
<html>
<head>
    <title>6-3</title>
</head>
<body>
    Correct Path<br>
    <?php
    /* 
    QUESTION:

    Have the function correctPath(str) read the str parameter being passed, which will represent the movements made in a 5x5 grid of cells starting from the top left position. The characters in the input string will be entirely composed of: r, l, u, d, ?. Each of the characters stand for the direction to take within the grid, for example: r = right, l = left, u = up, d = down. Your goal is to determine what characters the question marks should be in order for a path to be created to go from the top left of the grid all the way to the bottom right without touching previously travelled on cells in the grid.



    For example: if str is "r?d?drdd" then your program should output the final correct string that will allow a path to be formed from the top left of a 5x5 grid to the bottom right. For this input, your program should therefore return the string rrdrdrdd. There will only ever be one correct path and there will always be at least one question mark within the input string.

    ================================================================================

    Input:"???rrurdr?"

    Output:"dddrrurdrd"



    Input:"drdr??rrddd?"

    Output:"drdruurrdddd"
    */
    echo 'correctPath("???rrurdr?"): ' . correctPath('???rrurdr?');
    echo '<br>';
    echo 'correctPath("drdr??rrddd?"): ' . correctPath('drdr??rrddd?');

    function permutations(array $elements): iterator {
        if (count($elements) <= 1) {
            yield $elements;
        } else {
            foreach (permutations(array_slice($elements, 1)) as $permutation) {
                foreach (range(0, count($elements) - 1) as $i) {
                    yield array_merge(
                        array_slice($permutation, 0, $i),
                        [$elements[0]],
                        array_slice($permutation, $i)
                    );
                }
            }
        }
    }

    function correctPath(string $str): string {
        $net_down = $net_right = $moves = 0;
        $movesets = array();
        foreach (str_split($str) as $c) {
            switch ($c) {
                case 'u':
                    $net_down--;
                    break;
                case 'd':
                    $net_down++;
                    break;
                case 'l':
                    $net_right--;
                    break;
                case 'r':
                    $net_right++;
                    break;
                default:
                    $moves++;
                    break;
            }
        }
        $req_moves = '';
        if ($net_down < 5) {
            $req_moves .= str_repeat('d', (4 - $net_down));
            $moves -= 4 - $net_down;
        } else {
            $req_moves .= str_repeat('u', ($net_down - 4));
            $moves -= $net_down - 4;
        }
        if ($net_right < 5) {
            $req_moves .= str_repeat('r', (4 - $net_right));
            $moves -= 4 - $net_right;
        } else {
            $req_moves .= str_repeat('l', ($net_right - 4));
            $moves -= $net_right - 4;
        }
        if ($moves) {
            for ($i=0; $i <= $moves / 2; $i++) {
                $empty_pairs = str_repeat('ud', $i) . str_repeat('lr', $moves / 2 - $i);
                array_push($movesets, $req_moves . $empty_pairs);
            }
        } else {
            array_push($movesets, $req_moves);
        }
        foreach ($movesets as $moveset) {
            foreach (permutations(str_split($moveset)) as $missing_moves) {
                $move_seq = array();
                $m = 0;
                foreach (str_split($str) as $c) {
                    if ($c !== '?') {
                        array_push($move_seq, $c);
                    } else {
                        array_push($move_seq, $missing_moves[$m]);
                        $m++;
                    }
                }
                $row = array_fill(0, 5, 0);
                $grid = array_fill(0, 5, $row);
                $position = array(0, 4);
                foreach ($move_seq as $move) {
                    $grid[$position[0]][$position[1]] = 1;
                    switch ($move) {
                        case 'u':
                            $position[1]++;
                            break;
                        case 'd':
                            $position[1]--;
                            break;
                        case 'l':
                            $position[0]--;
                            break;
                        case 'r':
                            $position[0]++;
                            break;
                    }
                    if (
                        $position[0] < 0
                        || $position[0] > 4
                        || $position[1] < 0
                        || $position[1] > 4
                        || $grid[$position[0]][$position[1]] === 1
                    ) {
                        break;
                    }
                }
                if ($position[0] === 4 && $position[1] === 0) {
                    return implode('', $move_seq);
                }
            }
        }
        return 'No Correct Path';
    }
    ?>
</body>
</html>