<?php

$lines = explode("\n", file_get_contents("../input1.txt"));

$total = 0;
foreach ($lines as $row=>$line) {
    list($card, $points) = explode(":", $line);
    list($scratched, $winning) = explode("|", $points);
    $scratched = preg_split('/\s+/', trim($scratched));
    $winning = preg_split('/\s+/', trim($winning));
    $wins = 0;
    foreach ($scratched as $win) {
        if (in_array($win, $winning)) {
            $wins++;
        }
    }
    if ($wins>0) {
        print "$card]$wins: " . str_pad("1", $wins, "0") . "  " . bindec(str_pad("1", $wins, "0")) . "\n";
        $total += bindec(str_pad("1", $wins, "0"));
    } else {
        print "0 wins\n";
    }
}
var_dump($total);