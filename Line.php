<?php


class Line
{
    private $points = [];
    private $length = 0;

    public function __construct(string $input)
    {
        $x = $y = 0;
        foreach (explode(',', $input) as $turtle) {
            $direction = $turtle[0];
            $steps = (int)substr($turtle, 1);
            while ($steps--) {
                if ($direction === 'R') {
                    ++$x;
                } elseif ($direction === 'U') {
                    --$y;
                } elseif ($direction === 'L') {
                    --$x;
                } elseif ($direction === 'D') {
                    ++$y;
                }
                $this->setPoint($x, $y);
            }

            print '';
        }
    }

    private function setPoint(int $x, int $y)
    {
        $this->length++;
        if (!isset($this->points["$x.$y"])) {
            $this->points["$x.$y"] = [$x, $y, $this->length];
        }
    }

    /**
     * @return array[]
     */
    public function getPoints()
    {
        return $this->points;
    }
}
