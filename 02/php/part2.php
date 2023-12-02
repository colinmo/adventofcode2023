<?php

$lines = explode("\n", file_get_contents("../input.txt"));

$power_sum = 0;

foreach ($lines as $line) {    
    if ($line == "") {
        break;
    }
    
    $max = [
        'red' => 0,
        'green' => 0,
        'blue' => 0
    ];
    list($game,$values) = explode(":", $line);

    $pulls = explode(";", trim($values));
    foreach ($pulls as $pull) {
        $die = explode(", ", $pull);
        foreach ($die as $dice) {
            list($number, $color) = explode(" ", trim($dice));
            if ($number*1 > $max[trim($color)]) {
                $max[trim($color)] = $number*1;
            }
        }
    }
    $power_sum += $max['red']*$max['green']*$max['blue'];
}

var_dump($power_sum);