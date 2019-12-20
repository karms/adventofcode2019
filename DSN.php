<?php


class DSN
{

    private $input;
    private $layers = array();
    private $width;
    private $height;

    public function __construct(string $input)
    {
        $this->input = $input;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    public function process()
    {
        foreach (explode(PHP_EOL, chunk_split($this->input, $this->width * $this->height)) as $layer) {
            if (empty($layer)) {
                return;
            }
            $count = count_chars($layer, 1);
            $this->layers[] = [
                0 => ($count[48] ?? 0)
                , 1 => ($count[49] ?? 0)
                , 2 => ($count[50] ?? 0)
                , 'pixels' => str_split($layer)
            ];
        }
    }

    public function fewestZeroLayer()
    {
        $zerocount = PHP_INT_MAX;
        foreach ($this->layers as $id => $layer) {
            if ($layer[0] < $zerocount) {
                $zerocount = $layer[0];
                $layerId = $id;
            }
        }

        return $this->layers[$layerId][1] * $this->layers[$layerId][2];
    }

    public function getImage()
    {
        $image = [];
        foreach (range(0, $this->width * $this->height - 1) as $pos) {
            foreach ($this->layers as $layer) {
                $char = $layer['pixels'][$pos];
                if ($char != "2") {
                    $image[$pos] = $char == 1 ? '**' : '__';
                    break;
                }
            }
        }

        return chunk_split(join("", $image), $this->getWidth() * 2);
    }
}