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
            ['time'=>7,'distance'=>9],
            ['time'=>15,'distance'=>40],
            ['time'=>30, 'distance'=>200]
            ],
            $puzzle
        );
    }

    public function testGetWinningRaces(): void
    {
        $this->assertEquals(4, getWinningRaces(7,9));
        $this->assertEquals(8, getWinningRaces(15,40));
        $this->assertEquals(9, getWinningRaces(30,200));
    }

    public function testGetSolution(): void
    {
        $this->assertEquals(
            288,
            getSolution( [
                ['time'=>7,'distance'=>9],
                ['time'=>15,'distance'=>40],
                ['time'=>30, 'distance'=>200]
                ])
            );
    }
}
