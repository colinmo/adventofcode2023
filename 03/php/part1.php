<?php

$lines = explode("\n", file_get_contents("../input1.txt"));

$sum = 0;

$line_length = strlen($lines[0]);

foreach ($lines as $row => $line) {
    $col = 0;
    while ($col < $line_length) {
        if (is_numeric($line[$col])) {
            // Find full number
            $number = $line[$col];
            $startcol = $col - 1;
            $col++;
            while (is_numeric($line[$col])) {
                $number .= $line[$col];
                $col++;
            }
            $endcol = $col ;

            // Look for a symbol
            // Ends
            if (($lines[$row][$startcol] ?? ".") != "." || ($lines[$row][$endcol] ?? ".") != ".") {
                $sum += $number * 1;
            } else {
                for ($i = $startcol; $i < $endcol+1; $i++) {
                    // Top row
                    $spot = $lines[$row - 1][$i] ?? ".";
                    if (!is_numeric($spot) && $spot != ".") {
                        // Symbol, add
                        $sum += $number * 1;
                        break 1;
                    }
                    // Bottom row
                    $spot = $lines[$row + 1][$i] ?? ".";
                    if (!is_numeric($spot) && $spot != ".") {
                        // Symbol, add
                        $sum += $number * 1;
                        break 1;
                    }
                }
            }
        } else {
            $col++;
        }
    }
}

var_dump($sum);
