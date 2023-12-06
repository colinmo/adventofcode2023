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
        $puzzle_input = toPuzzle($lines);
        $this->assertIsArray($puzzle_input);
    }
    public function testPuzzle2Decode(): void
    {
        $lines = explode("\n", file_get_contents("../test1.txt"));
        $puzzle_input = toPuzzle($lines);

        $this->assertIsArray($puzzle_input);
        $this->assertEquals($puzzle_input['seeds'], [
            ['start' => 79, 'range'=>14, 'end' => 93],
            ['start' => 55, 'range'=>13, 'end' => 68]
        ]);
        $this->assertEquals($puzzle_input['seed-to-soil'], [
            ['dest' => 50, 'source' => 98, 'range' => 2, 'edest'=>52],
            ['dest' => 52, 'source' => 50, 'range' => 48, 'edest'=>100]
        ]);
        $this->assertEquals($puzzle_input['humidity-to-location'], [
            ['dest' => 60, 'source' => 56, 'range'=>37, 'edest' => 97],
            ['dest' => 56, 'source' => 93, 'range'=>4, 'edest' => 60]
        ]);
    }

    public function testLowestLocations(): void
    {
        $lines = explode("\n", file_get_contents("../test1.txt"));
        $puzzle_input = toPuzzle($lines);

        $this->assertEquals(46, lowestLocations($puzzle_input));

    }
}
