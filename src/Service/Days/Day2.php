<?php

namespace App\Service\Days;

class Day2
{
    public function generatePart1($rows): string
    {
        $maxTotals = [
            'red' => 12,
            'green' => 13,
            'blue' => 14
        ];
        $totalGameNumber = 0;

        foreach ($rows as $row) {
            $fairGame = true;
            $gameData = explode(': ', $row);
            $gameNumber = (explode(' ', $gameData[0]))[1];
            $games = explode('; ', $gameData[1]);
            foreach ($games as $game) {
                $gameBlocks = explode(', ', $game);
                foreach ($gameBlocks as $gameBlockData) {
                    $rollData = explode(' ', $gameBlockData);
                    if ($maxTotals[$rollData[1]] < (int)$rollData[0]) {
                        $fairGame = false;
                        break 2;
                    }
                }
            }
            if ($fairGame) {
                $totalGameNumber += (int)$gameNumber;
            }
        }

        return $totalGameNumber;
    }

    public function generatePart2($rows): string
    {
        $totalGameNumber = 0;
        foreach ($rows as $row) {
            $minTotals = [
                'red' => 0,
                'green' => 0,
                'blue' => 0
            ];
            $gameData = explode(': ', $row);
            $games = explode('; ', $gameData[1]);
            foreach ($games as $game) {
                $gameBlocks = explode(', ', $game);
                foreach ($gameBlocks as $gameBlockData) {
                    $rollData = explode(' ', $gameBlockData);
                    if ($minTotals[$rollData[1]] < (int)$rollData[0]) {
                        $minTotals[$rollData[1]] = (int)$rollData[0];
                    }
                }
            }
            $powerOfRow = $minTotals['red'] * $minTotals['green'] * $minTotals['blue'];
            $totalGameNumber += $powerOfRow;
        }

        return $totalGameNumber;
    }
}