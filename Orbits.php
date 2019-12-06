<?php


class Orbits
{
    private $orbits = [];
    private $outers = [];

    public function __construct(array $input)
    {
        foreach ($input as $orbit) {
            list($in, $out) = explode(')', $orbit);
            $this->orbits[$out] = $in;
            $this->outers[$in][] = $out;
        }
    }

    public function getOrbitCount()
    {
        $count = 0;
        foreach ($this->orbits as $planet => $_) {
            while ($planet !== 'COM') {
                $count++;
                $planet = $this->orbits[$planet];
            }
        }

        return $count;
    }

    public function transfers()
    {
        $visitedYOU = [];
        $visitedSAN = [];
        $objectsYOU = ['YOU'];
        $objectsSAN = ['SAN'];
        $transfers = 0;
        while (true) {
            foreach ($objectsYOU as $object) {
                if (isset($visitedSAN[$object])) {
                    return $visitedSAN[$object] + $transfers - 2;
                }
                $visitedYOU[$object] = $transfers;
            }
            foreach ($objectsSAN as $object) {
                if (isset($visitedYOU[$object])) {
                    return $visitedYOU[$object] + $transfers - 2;
                }
                $visitedSAN[$object] = $transfers;
            }

            $transfers++;
            $objectsYOU = array_diff($this->getLinkedObjects($objectsYOU), array_keys($visitedYOU));
            $objectsSAN = array_diff($this->getLinkedObjects($objectsSAN), array_keys($visitedSAN));
        }
        return 0;
    }

    /**
     * @param array $objects
     * @param array $visited
     * @return array
     */
    private function getLinkedObjects($objects)
    {
        $linked = [];
        foreach ($objects as $object) {
            if (isset($this->orbits[$object])) {
                $linked[] = $this->orbits[$object];
            }
            if (!empty($this->outers[$object])) {
                $linked = array_merge($linked, $this->outers[$object]);
            }
        }

        return array_unique($linked);
    }
}