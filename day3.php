<?php

$input = file_get_contents('input-day3.txt');

list($input1, $input2) = explode("\n", $input);

$crossings = new Crossings(new Line($input1), new Line($input2));
print "Part 1: " . $crossings->getClosestDistance();

$wires = new Wires(new Line($input1), new Line($input2));
print "\nPart 2: " . $wires->getLeastWireUsed();