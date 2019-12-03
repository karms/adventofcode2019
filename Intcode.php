<?php


class Intcode
{
    private $address = array();
    private $input = array();

    public function __construct(string $input)
    {
        $this->input = $this->address = array_map('intval', explode(',', $input));
    }

    /**
     * @return int
     * @throws Exception
     */
    public function step1() : int
    {
        return $this->run(12, 2);
    }

    /**
     * @param int $noun
     * @param int $verb
     * @return int
     * @throws Exception
     */
    private function run(int $noun, int $verb) : int
    {
        $this->address = $this->input;
        $this->address[1] = $noun;
        $this->address[2] = $verb;

        $pos = 0;
        while (1) {
            if (!isset($this->address[$pos])) {
                throw new Exception('pos not found');
            }

            if ($this->address[$pos] === 99) {
                return $this->address[0];
            }

            if (  !isset($this->address[$pos + 1])
               || !isset($this->address[$pos + 2])
               || !isset($this->address[$pos + 3])) {
                throw new Exception('pos not found');
            }

            $opcode = $this->address[$pos];
            $input1 = $this->address[$pos + 1];
            $input2 = $this->address[$pos + 2];
            $output = $this->address[$pos + 3];

            if (!isset($this->address[$input1]) || !isset($this->address[$input2])) {
                throw new Exception('input not found');
            } elseif (!isset($this->address[$output])) {
                throw new Exception('output not found');
            }

            if ($opcode === 1) {
                $this->address[$output] = $this->address[$input1] + $this->address[$input2];
            } elseif ($opcode === 2) {
                $this->address[$output] = $this->address[$input1] * $this->address[$input2];
            } else {
                throw new Exception('opcode not correct');
            }

            $pos += 4;
        }

        return 0;
    }

    /**
     * @param int $check
     * @return int
     * @throws Exception
     */
    public function step2(int $check) : int
    {
        foreach(range(0,99) as $noun) {
            foreach(range(0, 99) as $verb) {
                if($check === $this->run($noun, $verb)) {
                    return (100 * $noun) + $verb;
                }
            }
        }
        return 0;
    }
}