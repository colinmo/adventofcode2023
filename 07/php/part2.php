<?php

function toPuzzle($lines) {
    $return = [];

    foreach ($lines as $line) {
        [$hand, $bid] = explode(" ", $line);
        $return[] = [$hand, intval($bid), stringToHandRank($hand)];
    }
    return $return;
}

function stringToHandRank($hand) {
    $mep = str_split($hand);
    $matches = [];
    // Count each card sort
    foreach ($mep as $card) {
        $matches[$card] = ($matches[$card] ?? 0) + 1;
    }
    if (isset($matches['J'])) {
        // handle jokerness
        $jCount = $matches['J'];
        unset($matches['J']);
        if (in_array(4, $matches)) { // Four of a kind
            $matches[array_search(4, $matches)] ++;
            return 7;
        }
        if (in_array(3, $matches) && in_array(2, $matches)) { // Full house
            if ($jCount != 3) {
                $matches[array_search(3, $matches)]+=$jCount;
            } else {
                $matches[array_search(2, $matches)] += $jCount;
            }
            goto cards;
        }
        if (in_array(3, $matches)) { // Three of a kind
            $matches[array_search(3, $matches)] +=$jCount;
            goto cards;
        }
        if (count(array_keys($matches, 2)) == 2) { // 2 pair
            $matches[array_search(2, $matches)]+=$jCount;
            goto cards;
        }
        if (in_array(2, $matches)) { // One pair
            $matches[array_search(2, $matches)]+=$jCount;
            goto cards;
        }
        $matches[array_key_first($matches)]+=$jCount;
    }
    cards:
    // Convert to a score
    if (count($matches) == 5) { // High card
        return 1;
    }
    if (count($matches) == 4) { // One pair
        return 2;
    }
    if (count($matches) == 1) { // Five of a kind
        return 7;
    }
    if (in_array(3, $matches) && in_array(2, $matches)) { // Full house
        return 5;
    }
    if (in_array(4, $matches)) {// Four of a kind
        return 6;
    }
    if (in_array(3, $matches)) { // Three of a kind
        return 4;
    }
    return 3;
}

function sortHands($a, $b) {
    if ($a[2] == $b[2]) {
        for ($i=0;$i<strlen($a[0]);$i++) {
            if ($a[0][$i] == $b[0][$i]) {
                continue;
            }
            return (SCORE_RATINGS[$a[0][$i]] < SCORE_RATINGS[$b[0][$i]]) ? -1 : 1;
        }
    }
    return ($a[2] < $b[2]) ? -1 : 1;
}

function getSolution($puzzle) {
    $return = 0;
    define('SCORE_RATINGS', array_flip(array_reverse(['A', 'K', 'Q', 'T', 9, 8, 7, 6, 5, 4, 3, 2, 'J'])));
    define('SCORES', [7=>'5 of', 6 => '4 of', 5 => 'Full', 4 => '3 of', 3 => '2 of', 2 =>'Pair', 1=>'High']);
    usort($puzzle, 'sortHands');
    //print "\n";
    for ($i=0;$i<count($puzzle); $i++) {
        //print "{$puzzle[$i][0]}: " . SCORES[$puzzle[$i][2]] . " " . ($i+1) . " * {$puzzle[$i][1]}\n";
        $return += ($i+1) * $puzzle[$i][1];
    }
    return $return;
}


if (!function_exists('array_key_first')) {
    function array_key_first(array $arr) {
        foreach($arr as $key => $unused) {
            return $key;
        }
        return NULL;
    }
}