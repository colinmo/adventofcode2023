<?php

$lines = explode("\n", file_get_contents("../input1.txt"));

$total = 0;
$repeat_for_row = array_fill(0,count($lines), 1);
foreach ($lines as $card => $line) {
    // Add this card
    [$cardx, $scratched, $winning] = processRow($line);
    $total += $repeat_for_row[$card];
    $next_card = $card+1;
    foreach ($scratched as $win) {
        if (in_array($win, $winning)) {
            $repeat_for_row[$next_card] += $repeat_for_row[$card];
            $next_card++;
        }
    }
}
var_dump($total);

function processRow($line)
{
    list($card, $points) = explode(":", $line);
    list($scratched, $winning) = explode("|", $points);
    $scratched = preg_split('/\s+/', trim($scratched));
    $winning = preg_split('/\s+/', trim($winning));
    return [explode(" ", $card)[1], $scratched, $winning];
}
