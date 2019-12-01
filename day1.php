<?php

$file = file_get_contents('input-day1.txt');

function determine_fuel_for_distance($distance) {
    return max((int)floor((int)$distance / 3) - 2, 0);
}

function reduce(array $total) {
    return array_reduce($total, function($fuel, $remainder){
        return $fuel + $remainder;
        }, 0);
}

$fuels = array_map('determine_fuel_for_distance', explode("\n", $file));
print 'first half: ' .  reduce($fuels) . PHP_EOL;

function calculate_fuel($fuel, $first = true) {
    if ($fuel <= 0) return 0;
    if($first) {
        return calculate_fuel(determine_fuel_for_distance($fuel), false);
    }
    return $fuel + calculate_fuel(determine_fuel_for_distance($fuel), false);
}

$fuels = array_map('calculate_fuel', explode("\n", $file));
print 'second half: ' . reduce($fuels); // ‌9956517
