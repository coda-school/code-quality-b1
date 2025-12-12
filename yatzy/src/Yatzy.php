<?php

declare(strict_types=1);

namespace Yatzy;

class Yatzy
{
    public static function number(Roll $roll, int $searchedValue): int
    {
        return array_sum(
            array_filter($roll->dice(), fn($die) => $die === $searchedValue)
        );
    }

    public static function yatzy(Roll $roll): int
    {
        $counts = array_count_values($roll->dice());
        return in_array(5, $counts, true) ? 50 : 0;
    }

    public static function threeOfAKind(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $counts = array_count_values([$d1, $d2, $d3, $d4, $d5]);
        foreach ($counts as $value => $count) {
            if ($count >= 3) {
                return $value * 3;
            }
        }
        return 0;
    }


    public static function smallStraight(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $tallies = array_fill(0, 6, 0);
        ++$tallies[$d1 - 1];
        ++$tallies[$d2 - 1];
        ++$tallies[$d3 - 1];
        ++$tallies[$d4 - 1];
        ++$tallies[$d5 - 1];
        if ($tallies[0] === 1 &&
            $tallies[1] === 1 &&
            $tallies[2] === 1 &&
            $tallies[3] === 1 &&
            $tallies[4] === 1) {
            return 15;
        }
        return 0;
    }

    public static function largeStraight(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $tallies = array_fill(0, 6, 0);
        ++$tallies[$d1 - 1];
        ++$tallies[$d2 - 1];
        ++$tallies[$d3 - 1];
        ++$tallies[$d4 - 1];
        ++$tallies[$d5 - 1];
        if ($tallies[1] === 1 &&
            $tallies[2] === 1 &&
            $tallies[3] === 1 &&
            $tallies[4] === 1 &&
            $tallies[5] === 1) {
            return 20;
        }
        return 0;
    }

    public static function fullHouse(int $d1, int $d2, int $d3, int $d4, int $d5): int
    {
        $tallies = [];
        $_2 = false;
        $i = 0;
        $_2_at = 0;
        $_3 = false;
        $_3_at = 0;

        $tallies = array_fill(0, 6, 0);
        ++$tallies[$d1 - 1];
        ++$tallies[$d2 - 1];
        ++$tallies[$d3 - 1];
        ++$tallies[$d4 - 1];
        ++$tallies[$d5 - 1];

        foreach (range(0, 5) as $i) {
            if ($tallies[$i] === 2) {
                $_2 = true;
                $_2_at = $i + 1;
            }
        }

        foreach (range(0, 5) as $i) {
            if ($tallies[$i] === 3) {
                $_3 = true;
                $_3_at = $i + 1;
            }
        }

        if ($_2 && $_3) {
            return $_2_at * 2 + $_3_at * 3;
        }

        return 0;
    }

    public static function chance(Roll $roll): int
    {
        return $roll->sumDice();
    }
}
