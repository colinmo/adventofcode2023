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
        $puzzle_input = toPuzzle($lines);
        $this->assertIsArray($puzzle_input);
    }

    public function testPuzzle1Decode(): void
    {
        $lines = explode("\n", file_get_contents("../test1.txt"));
        $puzzle_input = toPuzzle($lines);

        $this->assertIsArray($puzzle_input);
        $this->assertEquals($puzzle_input['seeds'], ['79', '14', '55', '13']);
        $this->assertEquals($puzzle_input['seed-to-soil'], [
            ['dest' => 50, 'source' => 98, 'range' => 2, 'esource'=>100],
            ['dest' => 52, 'source' => 50, 'range' => 48, 'esource'=>98]
        ]);
        $this->assertEquals($puzzle_input['humidity-to-location'], [
            ['dest' => 60, 'source' => 56, 'range'=>37, 'esource' => 93],
            ['dest' => 56, 'source' => 93, 'range'=>4, 'esource' => 97]
        ]);
    }

    public function testGetPosition(): void
    {
        $lines = explode("\n", file_get_contents("../test1.txt"));
        $puzzle_input = toPuzzle($lines);

        $this->assertEquals(81, getPosition(79, [
            ['dest' => 50, 'source' => 98, 'range' => 2, 'esource'=>100],
            ['dest' => 52, 'source' => 50, 'range' => 48, 'esource' => 100]
        ]));
        $this->assertEquals(14, getPosition(14, [
            ['dest' => 50, 'source' => 98, 'range' => 2, 'esource'=>100],
            ['dest' => 52, 'source' => 50, 'range' => 48, 'esource' => 100]
        ]));

        $this->assertEquals(57, getPosition(55, [
            ['dest' => 50, 'source' => 98, 'range' => 2, 'esource'=>100],
            ['dest' => 52, 'source' => 50, 'range' => 48, 'esource' => 100]
        ]));
        $this->assertEquals(13, getPosition(13, [
            ['dest' => 50, 'source' => 98, 'range' => 2, 'esource'=>100],
            ['dest' => 52, 'source' => 50, 'range' => 48, 'esource' => 100]
        ]));
    }

    public function testLocation(): void
    {
        $lines = explode("\n", file_get_contents("../test1.txt"));
        $puzzle_input = toPuzzle($lines);

        unset($puzzle_input['seeds']);
        $this->assertEquals(82, getLocationNumber(79, $puzzle_input));
        $this->assertEquals(43, getLocationNumber(14, $puzzle_input));
        $this->assertEquals(86, getLocationNumber(55, $puzzle_input));
        $this->assertEquals(35, getLocationNumber(13, $puzzle_input));
    }

    public function testLowestLocations(): void
    {
        $lines = explode("\n", file_get_contents("../test1.txt"));
        $puzzle_input = toPuzzle($lines);

        $this->assertEquals(35, lowestLocations($puzzle_input));

    }
}
