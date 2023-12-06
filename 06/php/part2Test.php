<?php

declare(strict_types=1);

include '../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

include 'part2.php';
final class Part2Test extends TestCase
{
    public function testBasic(): void
    {
        $lines = explode("\n", file_get_contents("../test1.txt"));
        $puzzle = toPuzzle($lines);
        $this->assertIsArray($puzzle);
        $this->assertEquals(
            [
                'time' => 71530,
                'distance' => 940200
            ],
            $puzzle
        );
    }

    public function testGetWinningRaces(): void
    {
        $this->assertEquals(71503, getWinningRaces(71530,940200));
    }

    //public function testGetSolution(): void
    //{
    //    $this->assertEquals(
    //        288,
    //        getSolution( [
    //            ['time'=>7,'distance'=>9],
    //            ['time'=>15,'distance'=>40],
    //            ['time'=>30, 'distance'=>200]
    //            ])
    //        );
    //}
}
