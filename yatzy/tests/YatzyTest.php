<?php

declare(strict_types=1);

namespace Yatzy\Tests;

use PHPUnit\Framework\TestCase;
use Yatzy\Roll;
use Yatzy\Yatzy;
use function PHPUnit\Framework\assertSame;

class YatzyTest extends TestCase
{
    public function testOnes(): void
    {
        $this->assertNumber(1, array(1, 2, 3, 4, 5), 1);
        $this->assertNumber(2, array(1, 2, 1, 4, 5), 1);
        $this->assertNumber(0, array(6, 2, 2, 4, 5), 1);
        $this->assertNumber(4, array(1, 2, 1, 1, 1), 1);
    }

    /**
     * @param int $expectedValue
     * @param int[] $dice
     * @param int $number
     * @return void
     */
    private function assertNumber(int $expectedValue, array $dice, int $number): void
    {
        assertSame($expectedValue, Yatzy::number(Roll::from($dice), $number));
    }

    public function testTwos(): void
    {
        $this->assertNumber(4, array(1, 2, 3, 2, 6), 2);
        $this->assertNumber(10, array(2, 2, 2, 2, 2), 2);
    }

    public function testThrees(): void
    {
        $this->assertNumber(6, array(1, 2, 3, 2, 3), 3);
        $this->assertNumber(12, array(2, 3, 3, 3, 3), 3);
    }

    public function testFours(): void
    {
        $this->assertNumber(12, array(4, 4, 4, 5, 5), 4);
        $this->assertNumber(8, array(4, 4, 5, 5, 5), 4);
        $this->assertNumber(4, array(4, 5, 5, 5, 5), 4);
    }

    public function testFives(): void
    {
        $this->assertNumber(10, array(4, 4, 4, 5, 5), 5);
        $this->assertNumber(15, array(4, 4, 5, 5, 5), 5);
        $this->assertNumber(20, array(4, 5, 5, 5, 5), 5);
    }

    public function testSixes(): void
    {
        $this->assertNumber(0, array(4, 4, 4, 5, 5), 6);
        $this->assertNumber(6, array(4, 4, 6, 5, 5), 6);
        $this->assertNumber(18, array(6, 5, 6, 6, 5), 6);
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

    public function testChanceScoresSumOfAllDice(): void
    {
        assertSame(15, Yatzy::chance(Roll::from(array(2, 3, 4, 5, 1))));
        assertSame(16, Yatzy::chance(Roll::from(array(3, 3, 4, 5, 1))));
    }

    public function testYatzyScores50(): void
    {
        assertSame(50, Yatzy::yatzy(Roll::from(array(4, 4, 4, 4, 4))));
        assertSame(50, Yatzy::yatzy(Roll::from(array(6, 6, 6, 6, 6))));
        assertSame(0, Yatzy::yatzy(Roll::from(array(6, 6, 6, 6, 3))));
    }
}
