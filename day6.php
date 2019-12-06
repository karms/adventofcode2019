<?php

require_once 'Orbits.php';

$input = file_get_contents('input-day6.txt');

$orbits = new Orbits(explode("\r\n", $input));
print "Part 1: " . $orbits->getOrbitCount();

print "\nPart 2: " . $orbits->transfers();