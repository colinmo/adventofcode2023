<?php

$lines = explode("\n", file_get_contents("../input1.txt"));

$sum = 0;

$line_length = strlen($lines[0]);

foreach ($lines as $row => $line) {
    foreach (str_split($line) as $col => $value) {
        if ($value == "*") { // Gear, find attached numbers
            $numbers = [];

            $numbers = array_merge($numbers, rowParse($lines[$row - 1], $col)); //  Above
            $numbers = array_merge($numbers, rowParse($lines[$row + 1], $col)); //  Below
            if (is_numeric($lines[$row][$col - 1])) { //  Left
                $numbers[] = backtrackNumber($lines[$row], $col - 1);
            }
            if (is_numeric($lines[$row][$col + 1])) { // Right
                $numbers[] = forwardtrackNumber($lines[$row], $col + 1);
            }

            // If there are 2 numbers, multiply and add
            if (count($numbers) == 2) {
                $sum += $numbers[0] * $numbers[1];
            }
        }
    }
}

var_dump($sum);

function rowParse($line, $col)
{
    $numbers = [];
    if (is_numeric($line[$col])) {
        // Single number on top, backtrack
        $numbers[] = backtrackNumber($line, $col);
    } else {
        // 1 or two top numbers
        if (is_numeric($line[$col - 1])) {
            $numbers[] = backtrackNumber($line, $col - 1);
        }
        if (is_numeric($line[$col + 1])) {
            $numbers[] = forwardtrackNumber($line, $col + 1);
        }
    }
    return $numbers;
}

function backtrackNumber($line, $col)
{
    while (is_numeric($line[$col] ?? '.')) {
        $col--;
    }
    return forwardtrackNumber($line, $col + 1);
}

function forwardtrackNumber($line, $col)
{
    $number = "";
    while (is_numeric($line[$col] ?? '.')) {
        $number .= $line[$col];
        $col++;
    }
    return $number;
}
