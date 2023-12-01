package main

import (
	"bytes"
	"fmt"
	"os"
	"regexp"
	"strconv"
)

func main() {
	contents, _ := os.ReadFile("../input.txt")
	result := part1(contents)
	result2 := part2(contents)
	fmt.Printf("Result %d\n", result)
	fmt.Printf("Result %d\n", result2)
}

func part1(contents []byte) int {
	regex_start := regexp.MustCompile(`^[^\d]*(\d)`)
	regex_end := regexp.MustCompile(`^.*(\d)[^\d]*$`)
	lines := bytes.Split(contents, []byte("\n"))
	sum := 0
	for _, line := range lines {
		start := regex_start.FindSubmatch(line)
		end := regex_end.FindSubmatch(line)
		x, _ := strconv.Atoi(string(start[1]))
		sum += x * 10
		x, _ = strconv.Atoi(string(end[1]))
		sum += x
	}

	return sum
}
func part2(contents []byte) int {
	regex_start := regexp.MustCompile(`^.*?(zero|one|two|three|four|five|six|seven|eight|nine|ten|\d)`)
	regex_end := regexp.MustCompile(`^.*(zero|one|two|three|four|five|six|seven|eight|nine|ten|\d)`)
	number_swap := map[string]int{
		"zero": 0, "one": 1, "two": 2, "three": 3, "four": 4, "five": 5, "six": 6, "seven": 7, "eight": 8, "nine": 9,
	}
	lines := bytes.Split(contents, []byte("\n"))
	sum := 0
	for _, line := range lines {
		start := regex_start.FindSubmatch(line)
		end := regex_end.FindSubmatch(line)
		start1 := string(start[1])
		if v, ok := number_swap[start1]; ok {
			sum += v * 10
		} else {
			x, _ := strconv.Atoi(start1)
			sum += x * 10
		}
		end1 := string(end[1])

		if v, ok := number_swap[end1]; ok {
			sum += v
		} else {
			x, _ := strconv.Atoi(end1)
			sum += x
		}
	}

	return sum
}
