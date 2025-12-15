<?php

namespace Yatzy;

class Roll
{
    private const ROLL_LENGTH = 5;
    private const MINIMUM_DIE = 1;
    private const MAXIMUM_DIE = 6;

    /**
     * @var int[]
     */
    private array $dice;

    /**
     * @param int[] $dice
     */
    private function __construct(array $dice)
    {
        $this->dice = $dice;
    }

    /**
     * @param int[] $values
     * @return Roll
     * @throws InvalidRollException
     */
    public static function from(array $values): Roll
    {
        if (self::isInvalidLength($values)) {
            throw new InvalidRollException("Invalid dice... A roll should contain 5 dice.");
        }
        if (self::containsInvalidDie($values)) {
            throw new InvalidRollException("Invalid die value. Each die must be between 1 and 6.");
        }
        return new Roll($values);
    }

    /**
     * @param int[] $values
     * @return bool
     */
    private static function isInvalidLength(array $values): bool
    {
        return sizeof($values) != self::ROLL_LENGTH;
    }

    /**
     * @param int[] $dice
     * @return bool
     */
    private static function containsInvalidDie(array $dice): bool
    {
        return count(array_filter($dice, fn($die) => self::isInvalidDie($die))) > 0;
    }

    private static function isInvalidDie(int $die): bool
    {
        return $die < self::MINIMUM_DIE || $die > self::MAXIMUM_DIE;
    }

    public function sumDice(): int
    {
        return array_sum($this->dice);
    }

    /**
     * @return array<int<1, max>>
     */
    public function groupByValues(): array
    {
        return array_count_values($this->dice);
    }

    /**
     * @param int $searchedValue
     * @return int[]
     */
    public function filter(int $searchedValue): array
    {
        return array_filter($this->dice, fn($die) => $die === $searchedValue);
    }

    /**
     * @return int[]
     */
    public function sortedDice(): array
    {
        $originalArray = $this->dice;
        $sortedArray = $originalArray;
        sort($sortedArray);

        return $sortedArray;
    }
}
