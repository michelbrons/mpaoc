<?php

namespace App\Service\Days;

class Day1
{
    public function generatePart1($rows): string
    {
        $total = 0;
        foreach ($rows as $subString) {
            $numbers = array_filter(preg_split("/\D+/", $subString));
            if (!empty($numbers)) {
                $first = mb_substr(reset($numbers), 0, 1);
                $last = mb_substr(end($numbers), -1);
                $total += (int)($first.$last);
            }
        }

        return $total;
    }

    public function generatePart2($rows): string
    {
        $numberStringOptions = [
            1 => "one",
            2 => "two",
            3 => "three",
            4 => "four",
            5 => "five",
            6 => "six",
            7 => "seven",
            8 => "eight",
            9 => "nine"
        ];

        $total = 0;
        foreach ($rows as $subString) {
            $inStringData = [
                'first' => null,
                'firstPosition' => null,
                'last' => null,
                'lastPosition' => null,
            ];
            foreach ($numberStringOptions as $int => $option) {
                $this->getInstringData($inStringData, $subString, $option, $int);
            }

            foreach (array_keys($numberStringOptions) as $option) {
                $this->getInstringData($inStringData, $subString, $option);
            }

            $total += (int)($inStringData['first'].$inStringData['last']);
        }

        return $total;
    }

    private function getInstringData(&$inStringData, $subString, $option, $key = null): void
    {
        $position = strpos($subString,$option);
        if (false !== $position) {
            if (null === $inStringData['firstPosition'] || $inStringData['firstPosition'] > $position) {
                $inStringData['firstPosition'] = $position;
                $inStringData['first'] = $key ?? (int)$option;
            }
        }
        $position = strrpos($subString,$option);
        if (false !== $position) {
            if (null === $inStringData['lastPosition'] || $inStringData['lastPosition'] < $position) {
                $inStringData['lastPosition'] = $position;
                $inStringData['last'] = $key ?? (int)$option;
            }
        }
    }
}
