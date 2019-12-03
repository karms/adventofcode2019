<?php


class Crossings
{
    private $crossings = [];

    public function __construct(Line $line1, Line $line2)
    {
        foreach (array_intersect_key($line1->getPoints(), $line2->getPoints()) as $point) {
            $distance = abs($point[0]) + abs($point[1]);
            $this->crossings[$distance][] = $point;
        }
    }

    public function getClosestDistance()
    {
        $crossings = array_keys($this->crossings);
        sort($crossings);
        return $crossings[0];
    }
}
