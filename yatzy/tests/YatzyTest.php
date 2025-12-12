<?php

declare(strict_types=1);

namespace Yatzy\Tests;

use PHPUnit\Framework\TestCase;
use Yatzy\Yatzy;

class YatzyTest extends TestCase
{
    public function testChanceScoresSumOfAllDice(): void
    {
        $expected = 15;
        $actual = Yatzy::chance(2, 3, 4, 5, 1);
        self::assertSame($expected, $actual);
        self::assertSame(16, Yatzy::chance(3, 3, 4, 5, 1));
    }

    public function testYatzyScores50(): void
    {
        $expected = 50;
        $actual = Yatzy::yatzyScore([4, 4, 4, 4, 4]);
        self::assertSame($expected, $actual);
        self::assertSame(50, Yatzy::yatzyScore([6, 6, 6, 6, 6]));
        self::assertSame(0, Yatzy::yatzyScore([6, 6, 6, 6, 3]));
    }

    public function test1s(): void
    {
        self::assertSame(1, Yatzy::number(array(1, 2, 3, 4, 5), 1));
        self::assertSame(2, Yatzy::number(array(1, 2, 1, 4, 5), 1));
        self::assertSame(0, Yatzy::number(array(6, 2, 2, 4, 5), 1));
        self::assertSame(4, Yatzy::number(array(1, 2, 1, 1, 1), 1));
    }

    public function test2s(): void
    {
        self::assertSame(4, Yatzy::number(array(1, 2, 3, 2, 6), 2));
        self::assertSame(10, Yatzy::number(array(2, 2, 2, 2, 2), 2));
    }

    public function testThrees(): void
    {
        self::assertSame(6, Yatzy::number(array(1, 2, 3, 2, 3), 3));
        self::assertSame(12, Yatzy::number(array(2, 3, 3, 3, 3), 3));
    }

    public function testFoursTest(): void
    {
        self::assertSame(12, Yatzy::number(array(4, 4, 4, 5, 5), 4));
        self::assertSame(8, Yatzy::number(array(4, 4, 5, 5, 5), 4));
        self::assertSame(4, Yatzy::number(array(4, 5, 5, 5, 5), 4));
    }

    public function testFives(): void
    {
        self::assertSame(10, Yatzy::number(array(4, 4, 4, 5, 5), 5));
        self::assertSame(15, Yatzy::number(array(4, 4, 5, 5, 5), 5));
        self::assertSame(20, Yatzy::number(array(4, 5, 5, 5, 5), 5));
    }

    public function sixes_test(): void
    {
        self::assertSame(0, Yatzy::number(array(4, 4, 4, 5, 5), 6));
        self::assertSame(6, Yatzy::number(array(4, 4, 6, 5, 5), 6));
        self::assertSame(18, Yatzy::number(array(6, 5, 6, 6, 5), 6));
    }

    public function testOnePair(): void
    {
        self::assertSame(6, (new Yatzy(3, 4, 3, 5, 6))->scorePair(3, 4, 3, 5, 6));
        self::assertSame(10, (new Yatzy(5, 3, 3, 3, 5))->scorePair(5, 3, 3, 3, 5));
        self::assertSame(12, (new Yatzy(5, 3, 6, 6, 5))->scorePair(5, 3, 6, 6, 5));
    }

    public function testTwoPair(): void
    {
        self::assertSame(16, Yatzy::twoPairs(3, 3, 5, 4, 5));
        self::assertSame(18, Yatzy::twoPairs(3, 3, 6, 6, 6));
        self::assertSame(0, Yatzy::twoPairs(3, 3, 6, 5, 4));
    }

    public function testThreeOfAKind(): void
    {
        self::assertSame(9, Yatzy::threeOfAKind(3, 3, 3, 4, 5));
        self::assertSame(15, Yatzy::threeOfAKind(5, 3, 5, 4, 5));
        self::assertSame(9, Yatzy::threeOfAKind(3, 3, 3, 2, 1));
    }

    public function testSmallStraight(): void
    {
        self::assertSame(15, Yatzy::smallStraight(1, 2, 3, 4, 5));
        self::assertSame(15, Yatzy::smallStraight(2, 3, 4, 5, 1));
        self::assertSame(0, Yatzy::smallStraight(1, 2, 2, 4, 5));
    }

    public function testLargeStraight(): void
    {
        self::assertSame(20, Yatzy::largeStraight(6, 2, 3, 4, 5));
        self::assertSame(20, Yatzy::largeStraight(2, 3, 4, 5, 6));
        self::assertSame(0, Yatzy::largeStraight(1, 2, 2, 4, 5));
    }

    public function testFullHouse(): void
    {
        self::assertSame(18, Yatzy::fullHouse(6, 2, 2, 2, 6));
        self::assertSame(0, Yatzy::fullHouse(2, 3, 4, 5, 6));
    }
}
