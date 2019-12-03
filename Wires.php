<?php


class Wires
{
    private $wires = [];

    public function __construct(Line $line1, Line $line2)
    {
        $points1 = $line1->getPoints();
        $points2 = $line2->getPoints();
        $crossings = array_intersect(array_keys($points1), array_keys($points2));
        foreach ($crossings as $crossing) {
            $this->wires[] = $points1[$crossing][2] + $points2[$crossing][2];
        }
    }

    public function getLeastWireUsed()
    {
        sort($this->wires);
        return $this->wires[0];
    }
}