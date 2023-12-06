<?php

function toPuzzle($lines)
{
    $seeds = explode(" ", trim(explode(":", $lines[0])[1]));
    $dataset = [
        "seeds" => []
    ];
    for ($i = 0; $i < count($seeds); $i += 2) {
        $dataset['seeds'][] = [
            'start' => $seeds[$i],
            'range' => $seeds[$i + 1],
            'end' => $seeds[$i] + $seeds[$i + 1]
        ];
    }
    unset($lines[0]);
    unset($lines[1]);
    $set = "";
    foreach ($lines as $line) {
        if (strpos($line, ":") > -1) {
            $set = trim(explode(" ", $line)[0]);
            $dataset[$set] = [];
        } else {
            $this_row = explode(' ', trim($line));
            if (count($this_row) > 2) {
                $dataset[$set][] = [
                    'dest' => intval($this_row[0]),
                    'source' => intval($this_row[1]),
                    'range' => intval($this_row[2]),
                    'edest' => intval($this_row[0]) + intval($this_row[2])
                ];
            }
        }
    }
    return $dataset;
}


// Given the bigger range, now we start with
// a guessed minimum of 1, and check in reverse 
// to see if there's a seed that fits
function lowestLocations($lines)
{
    $min = 1;

    $seeds = $lines['seeds'];
    unset($lines['seeds']);
    $lines = array_reverse($lines);


    for ($min = 1;; $min++) {
        if ($min % 100000 == 0) {
            print ".";
        }
        if ($min % 3000000 == 0) {
            print "\n";
        }
        $seed = getSeedNumber($min, $lines);
        // check that the seed's in the list
        foreach ($seeds as $seed_range) {
            if (($seed_range['start'] <= $seed) && ($seed <= $seed_range['end'])) {
                return $min;
            }
        }
    }
}

function getSeedNumber($location, &$reversed_dataset)
{
    foreach ($reversed_dataset as $set) {
        $location = getSource($location, $set);
    }
    return $location;
}

function getSource($location, $dataset)
{
    foreach ($dataset as $set) {
        $source = $location + $set['source'] - $set['dest'];
        if ($set['source'] <= $source && $source < $set['source'] + $set['range']) {
            return $source;
        }
    }
    return $location;
}
