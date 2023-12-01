<?php

$lines = explode("\n", file_get_contents("input.txt"));
$newlines = 0;
$numbermatch = '(zero|one|two|three|four|five|six|seven|eight|nine|ten|\d)';
$numberswap = array_flip(['zero','one','two','three','four','five','six','seven','eight','nine']);
foreach ($lines as $D) {
    $start = [];
    $end = [];
    preg_match("/^.*?{$numbermatch}/", $D, $start);
    preg_match("/^.*{$numbermatch}/", $D, $end);

    $newlines += ($numberswap[$start[1]]??$start[1])*10;
    $newlines += $numberswap[$end[1]]??$end[1];
}

var_dump($newlines);
// 55652