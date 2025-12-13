<?php

declare(strict_types=1);

namespace Yatzy;

class Yatzy
{
    private const YATZY_SCORE = 50;
    private const SMALL_STRAIGHT = 15;
    private const LARGE_STRAIGHT = 20;

    public static function number(Roll $roll, int $searchedValue): int
    {
        return array_sum(
            array_filter($roll->dice(), fn($die) => $die === $searchedValue)
        );
    }

    public static function yatzy(Roll $roll): int
    {
        return in_array(5, $roll->groupByValues(), true)
            ? self::YATZY_SCORE
            : 0;
    }

    public static function threeOfAKind(Roll $roll): int
    {
        return self::scoreNOfAKind($roll, 3);
    }

    private static function scoreNOfAKind(Roll $roll, int $nOfAKind): int
    {
        $counts = $roll->groupByValues();
        foreach ($counts as $value => $count) {
            if ($count >= $nOfAKind) {
                return $value * $nOfAKind;
            }
        }
        return 0;
    }

    public static function fourOfAKind(Roll $roll): int
    {
        return self::scoreNOfAKind($roll, 4);
    }

    public static function smallStraight(Roll $roll): int
    {
        $dice = $roll->dice();
        sort($dice);
        return ($dice === [1, 2, 3, 4, 5]) ? self::SMALL_STRAIGHT : 0;
    }

    public static function largeStraight(Roll $roll): int
    {
        $dice = $roll->dice();
        return (count(array_unique($dice)) === 5 && !array_diff([2, 3, 4, 5, 6], $dice)) ? self::LARGE_STRAIGHT : 0;
    }

    public static function fullHouse(Roll $roll): int
    {
        $counts = $roll->groupByValues();
        $hasPair = false;
        $hasThree = false;
        $pairValue = 0;
        $threeValue = 0;

        // key => value
        foreach ($counts as $value => $count) {
            if ($count === 2) {
                $hasPair = true;
                $pairValue = $value;
            }
            if ($count === 3) {
                $hasThree = true;
                $threeValue = $value;
            }
        }
        return ($hasPair && $hasThree) ? ($pairValue * 2 + $threeValue * 3) : 0;
    }


    public static function chance(Roll $roll): int
    {
        return $roll->sumDice();
    }
}
