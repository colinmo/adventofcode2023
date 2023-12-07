<?php

declare(strict_types=1);

include '../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

include 'part2.php';
final class Part1Test extends TestCase
{
    public function testBasic(): void
    {
        $lines = explode("\n", file_get_contents("../test1.txt"));
        $puzzle = toPuzzle($lines);
        $this->assertIsArray($puzzle);
        $this->assertEquals(
            [
                ['32T3K',765, 2],
                ['T55J5',684, 6],
                ['KK677',28, 3],
                ['KTJJT',220, 6],
                ['QQQJA',483, 6]
            ],
            $puzzle
        );
    }
    public function testGetSolution(): void
    {
        $this->assertEquals(
            5905,
            getSolution([
                ['32T3K',765, 2],
                ['T55J5',684, 6],
                ['KK677',28, 3],
                ['KTJJT',220, 6],
                ['QQQJA',483, 6]
            ])
            );
    }
}
