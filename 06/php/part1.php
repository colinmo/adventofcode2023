<?php

function toPuzzle($lines) {
    $return = [];

    $times = [];
    preg_match_all('(\d+)', $lines[0], $times);
    $times = array_map('intval', $times[0]);

    $distances = [];
    preg_match_all('(\d+)', $lines[1], $distances);
    $distances = array_map('intval', $distances[0]);

    foreach ($times as $K=>$D) {
        $return[] = [
            'time' => (int)$D,
            'distance' => (int)$distances[$K]
        ];
    }
    return $return;
}

function getWinningRaces($time, $distance) {
    $lose = true;
    $start = intval($time/6);

    $startWin = 0;
    $endWin = 0;

    // From start
    while($lose) {
        if (($time-$start)*$start > $distance) {
            $lose=false;
            $startWin = $start;
            break;
        }
        $start++;
    }

    // From end
    $start = ceil(($time/6)*5);
    $lose = true;
    while($lose) {
        if (($time-$start)*$start > $distance) {
            $lose=false;
            $endWin = $start;
            break;
        }
        $start--;
    }

    return $endWin-$startWin+1;
}

function getSolution($puzzle) {
    $return = 1;
    foreach ($puzzle as $puzz) {
        $return *= getWinningRaces($puzz['time'], $puzz['distance']);
    }
    return $return;
}