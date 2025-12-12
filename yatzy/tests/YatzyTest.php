<?php

declare(strict_types=1);

namespace Yatzy\Tests;

use PHPUnit\Framework\TestCase;
use Yatzy\Roll;
use Yatzy\Yatzy;
use function PHPUnit\Framework\assertSame;

class YatzyTest extends TestCase
{
    public function testChanceScoresSumOfAllDice(): void
    {
        assertSame(15, Yatzy::newChance(Roll::from(array(2, 3, 4, 5, 1))));
        assertSame(16, Yatzy::chance(3, 3, 4, 5, 1));
    }

    public function testYatzyScores50(): void
    {
        assertSame(50, Yatzy::yatzyScore([4, 4, 4, 4, 4]));
        assertSame(50, Yatzy::yatzyScore([6, 6, 6, 6, 6]));
        assertSame(0, Yatzy::yatzyScore([6, 6, 6, 6, 3]));
    }

    public function test1s(): void
    {
        assertSame(1, Yatzy::number(array(1, 2, 3, 4, 5), 1));
        assertSame(2, Yatzy::number(array(1, 2, 1, 4, 5), 1));
        assertSame(0, Yatzy::number(array(6, 2, 2, 4, 5), 1));
        assertSame(4, Yatzy::number(array(1, 2, 1, 1, 1), 1));
    }

    public function test2s(): void
    {
        assertSame(4, Yatzy::number(array(1, 2, 3, 2, 6), 2));
        assertSame(10, Yatzy::number(array(2, 2, 2, 2, 2), 2));
    }

    public function testThrees(): void
    {
        assertSame(6, Yatzy::number(array(1, 2, 3, 2, 3), 3));
        assertSame(12, Yatzy::number(array(2, 3, 3, 3, 3), 3));
    }

    public function testFoursTest(): void
    {
        assertSame(12, Yatzy::number(array(4, 4, 4, 5, 5), 4));
        assertSame(8, Yatzy::number(array(4, 4, 5, 5, 5), 4));
        assertSame(4, Yatzy::number(array(4, 5, 5, 5, 5), 4));
    }

    public function testFives(): void
    {
        assertSame(10, Yatzy::number(array(4, 4, 4, 5, 5), 5));
        assertSame(15, Yatzy::number(array(4, 4, 5, 5, 5), 5));
        assertSame(20, Yatzy::number(array(4, 5, 5, 5, 5), 5));
    }

    public function sixes_test(): void
    {
        assertSame(0, Yatzy::number(array(4, 4, 4, 5, 5), 6));
        assertSame(6, Yatzy::number(array(4, 4, 6, 5, 5), 6));
        assertSame(18, Yatzy::number(array(6, 5, 6, 6, 5), 6));
    }

    public function testOnePair(): void
    {
        assertSame(6, Yatzy::scorePair(3, 4, 3, 5, 6));
        assertSame(10, Yatzy::scorePair(5, 3, 3, 3, 5));
        assertSame(12, Yatzy::scorePair(5, 3, 6, 6, 5));
    }

    public function testTwoPair(): void
    {
        assertSame(16, Yatzy::twoPairs(3, 3, 5, 4, 5));
        assertSame(18, Yatzy::twoPairs(3, 3, 6, 6, 6));
        assertSame(0, Yatzy::twoPairs(3, 3, 6, 5, 4));
    }

    public function testThreeOfAKind(): void
    {
        assertSame(9, Yatzy::threeOfAKind(3, 3, 3, 4, 5));
        assertSame(15, Yatzy::threeOfAKind(5, 3, 5, 4, 5));
        assertSame(9, Yatzy::threeOfAKind(3, 3, 3, 2, 1));
    }

    public function testSmallStraight(): void
    {
        assertSame(15, Yatzy::smallStraight(1, 2, 3, 4, 5));
        assertSame(15, Yatzy::smallStraight(2, 3, 4, 5, 1));
        assertSame(0, Yatzy::smallStraight(1, 2, 2, 4, 5));
    }

    public function testLargeStraight(): void
    {
        assertSame(20, Yatzy::largeStraight(6, 2, 3, 4, 5));
        assertSame(20, Yatzy::largeStraight(2, 3, 4, 5, 6));
        assertSame(0, Yatzy::largeStraight(1, 2, 2, 4, 5));
    }

    public function testFullHouse(): void
    {
        assertSame(18, Yatzy::fullHouse(6, 2, 2, 2, 6));
        assertSame(0, Yatzy::fullHouse(2, 3, 4, 5, 6));
    }
}
