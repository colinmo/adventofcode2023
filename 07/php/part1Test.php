<?php

declare(strict_types=1);

include '../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

include 'part1.php';
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
                ['T55J5',684, 4],
                ['KK677',28, 3],
                ['KTJJT',220, 3],
                ['QQQJA',483, 4]
            ],
            $puzzle
        );
    }
    public function testGetSolution(): void
    {
        $this->assertEquals(
            6440,
            getSolution([
                ['32T3K',765, 2],
                ['T55J5',684, 4],
                ['KK677',28, 3],
                ['KTJJT',220, 3],
                ['QQQJA',483, 4]
            ])
            );
    }
}
