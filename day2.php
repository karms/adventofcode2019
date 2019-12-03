<?php
require_once 'Intcode.php';

$input = file_get_contents('input-day2.txt');

$Intcode = new Intcode($input);
try {
    print 'part 1 : ' . $Intcode->step1();

    $Intcode = new Intcode($input);
    print PHP_EOL . 'part 2 : ' . $Intcode->step2(19690720);

} catch (Exception $e) {
}