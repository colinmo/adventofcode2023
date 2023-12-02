<?php

$lines = explode("\n", file_get_contents("../input.txt"));

$bag = [
    'red' => 12,
    'green' => 13,
    'blue' => 14
];

$sets_id_sum = 0;

foreach ($lines as $line) {
    if ($line == "") {
        break;
    }
    $ok = true;
    list($game,$values) = explode(":", $line);

    $pulls = explode(";", trim($values));
    foreach ($pulls as $pull) {
        $die = explode(", ", $pull);
        foreach ($die as $dice) {
            list($number, $color) = explode(" ", trim($dice));
            if ($number*1 > $bag[trim($color)]) {
                $ok = false;
                break 2;
            }
        }
    }
    if ($ok) {
        $gameNumber = substr($game,5);
        $sets_id_sum += $gameNumber*1;
    }
}

var_dump($sets_id_sum);