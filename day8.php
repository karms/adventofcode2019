<?php

require_once 'DSN.php';

$input = file_get_contents('input-day8.txt');
//$input = "0222112222120000";

$dsn = new DSN($input);
$dsn->setWidth(25);
$dsn->setHeight(6);
$dsn->process();

print "Part 1: " . $dsn->fewestZeroLayer();
print "\nPart 2: \n" . $dsn->getImage();