<?php

$input = "307237-769058";

list($start, $end) = explode('-', $input);

$solutions = [];
while ($start <= $end) {
    $numbers = str_split((string)$start);
    $start++;

    $number = array_shift($numbers);
    $double = false;
    $repeat_count = 0;
    do {
        $prev = $number;
        $number = array_shift($numbers);
        if ($prev > $number) {
            continue 2;
        }
        if ($prev == $number) {
            $double = true;
        }
    } while ($numbers);

    if ($double) {
        $solutions[] = $start - 1;
    }
}

print "Part 1 solution: " . count($solutions);

$solutionsPart2 = array_filter($solutions, function ($solution) {
    $numbers = str_split((string)$solution);
    $number = array_shift($numbers);
    $repeat_count = 1;
    do {
        $prev = $number;
        $number = array_shift($numbers);
        if ($prev == $number) {
            $repeat_count++;
        } elseif ($repeat_count == 2) {
            break;
        } else {
            $repeat_count = 1;
        }
    } while ($numbers);


    return $repeat_count == 2;
});

print "\nPart 2 solution: " . count($solutionsPart2);
