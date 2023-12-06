<?php

function toPuzzle($lines)
{
    $seeds = explode(" ", trim(explode(":", $lines[0])[1]));
    array_walk($seeds, 'intval');
    $dataset = [
        "seeds" => $seeds
    ];
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
                    'esource' => intval($this_row[1]) + intval($this_row[2])
                ];
            }
        }
    }
    return $dataset;
}


function lowestLocations($lines)
{
    $min = INF;

    $seeds = $lines['seeds'];
    unset($lines['seeds']);
    foreach ($seeds as $seed) {
        $min = min($min, getLocationNumber($seed, $lines));
    }
    return $min;
}

function getLocationNumber($seed, &$datasets)
{
    foreach ($datasets as $set) {
        $seed = getPosition($seed, $set);
    }
    return $seed;
}

function getPosition($seed, $dataset)
{
    // For each entry in the dataset
    foreach ($dataset as $set) {
        // If it is between SDest and EDest, map and return
        if ($set['source'] <= $seed && $seed <= $set['esource']) {
            return $set['dest'] + ($seed - $set['source']);
        }
    }
    // no match, return value
    return $seed;
}
