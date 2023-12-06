<?php

if ($argc>0) {
    if ($argv[1] == "1") {
        include 'part1.php';
        $lines = explode("\n", file_get_contents("../input1.txt"));
        var_dump(lowestLocations(toPuzzle($lines)));
    }
    if ($argv[1] == "2") {
        include 'part2.php';
        $lines = explode("\n", file_get_contents("../input1.txt"));
        var_dump(lowestLocations(toPuzzle($lines)));
    }
}