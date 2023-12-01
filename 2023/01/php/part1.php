<?php

$lines = explode("\n", file_get_contents("../input.txt"));
$newlines = 0;
foreach ($lines as $D) {
    $start = [];
    $end = [];
    preg_match("/^[^\d]*(\d)/", $D, $start);
    preg_match("/^.*(\d)[^\d]*$/", $D, $end);
    $newlines += $start[1]*10+$end[1];
}

var_dump($newlines);
// 56108