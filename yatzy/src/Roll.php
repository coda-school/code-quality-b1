<?php

namespace Yatzy;

class Roll
{
    /**
     * @var int[]
     */
    private array $values;

    /**
     * @param int[] $values
     */
    private function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @param int[] $values
     * @return Roll
     */
    public static function from(array $values): Roll
    {
        return new Roll($values);
    }

    /**
     * @return int[]
     */
    public function dice(): array
    {
        return $this->values;
    }

    public function sumDice(): int
    {
        return array_sum($this->values);
    }
}
