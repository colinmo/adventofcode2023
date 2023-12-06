<?php
declare(strict_types=1);

function toPuzzle($lines) {
    $return = [];

    $times = [];
    preg_match_all('(\d+)', $lines[0], $times);
    $times = intval(implode('',$times[0]));

    $distances = [];
    preg_match_all('(\d+)', $lines[1], $distances);
    $distances = intval(implode('',$distances[0]));

    return [
        'time' => $times,
        'distance' => $distances
    ];
}

function getWinningRaces($time, $distance) {
    $presstime = intval($time/3);
    $endWin = 0;
    $startWin = 0;

    $lasttime = 0;
    $lastwon = false;
    $loop=0;
    while ($loop++ < 200) {
        $thistime = $presstime;
        $thisdistance = ($time-$presstime)*$presstime;
        $thiswin = $thisdistance > $distance;
        if (abs($lasttime-$presstime)==1) {
            if ($lastwon && $thiswin) {
                $startWin = min($lastwon,$thiswin);
                break;
            } else {
                if ($lastwon) {
                    $startWin = $lasttime;
                    break;
                } elseif ($thiswin) {
                    $startWin = $thistime;
                    break;
                }
            }
        }
        if ($thiswin) {
            if ($lastwon) {
                if ($lasttime < $presstime) {
                    $presstime = $lasttime - ceil(($presstime-$lasttime) / 2);
                } else {
                    $presstime = $presstime - ceil(($lasttime-$presstime) / 2);
                }
            } else {
                $presstime = intval(($lasttime + $presstime) / 2);
            }
        } else {
            if ($lastwon) {
                $presstime = intval(($lasttime + $presstime) / 2);
            } else {
                if ($lasttime > $presstime) {
                    $presstime = $lasttime + ceil(($lasttime-$presstime) / 2);
                } else {
                    $presstime = $presstime + ceil(($presstime-$lasttime) / 2);
                }
            }
        }
        $lasttime = $thistime;
        $lastwon = $thiswin;
    }
    $presstime = ceil($time/3*2);
    $loop=0;
    $lasttime = $time;
    while ($loop++ < 100) {
        $thistime = $presstime;
        $thisdistance = ($time-$presstime)*$presstime;
        $thiswin = $thisdistance > $distance;
        if (abs($lasttime-$presstime)==1) {
            if ($lastwon && $thiswin) {
                $endWin = max($lastwon,$thiswin);
                break;
            } else {
                if ($lastwon) {
                    $endWin = $lasttime;
                    break;
                } elseif ($thiswin) {
                    $endWin = $thistime;
                    break;
                }
            }
        }
        if ($thiswin) {
            if ($lastwon) {
                if ($lasttime > $presstime) {
                    $presstime = $lasttime + ceil(($lasttime-$presstime) / 2);
                } else {
                    $presstime = $presstime + ceil(($presstime-$lasttime) / 2);
                }
            } else {
                $presstime = ceil(($lasttime + $presstime) / 2);
            }
        } else {
            if ($lastwon) {
                $presstime = ceil(($lasttime + $presstime) / 2);
            } else {
                if ($lasttime < $presstime) {
                    $presstime = $lasttime - ceil(($presstime-$lasttime) / 2);
                } else {
                    $presstime = $presstime - ceil(($lasttime-$presstime) / 2);
                }
            }
        }
        $lasttime = $thistime;
        $lastwon = $thiswin;
    }

    return $endWin-$startWin+1;
}

function getSolution($puzzle) {
        $return = getWinningRaces($puzzle['time'], $puzzle['distance']);
    return $return;
}