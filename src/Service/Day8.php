<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Day8 extends AbstractController
{
    public function __construct(private readonly LCM $LCM)
    {
    }

    public function generatePart1($rows): int
    {
        $directionMapper = [
            'L' => 0,
            'R' => 1
        ];
        $start = 'AAA';
        $end = 'ZZZ';

        $mapData = [];

        $mapDirections = [];
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }

            if (empty($mapDirections)) {
                $mapDirections = str_split($row);
                continue;
            }
            [$mapName, $directions] = explode(' = ', $row);
            $mapData[$mapName] = explode(', ', str_replace(['(', ')'], '',$directions));
        }

        return $this->findEndPosition($start, $end, $directionMapper, $mapDirections, $mapData);
    }

    private function findEndPosition(string $start, string $end, array $directionMapper, array $mapDirections, array $mapData): int
    {
        $i = 0;
        $found = false;

        $currentPosition = $start;

        while (!$found) {
            // loop over de mapdirections en tel het aantal op
            if ($currentPosition === $end) {
                break;
            }
            foreach ($mapDirections as $direction) {
                $i++;
                $currentPosition = $mapData[$currentPosition][$directionMapper[$direction]];
            }
        }

        return $i;
    }

    public function generatePart2($rows): string
    {
        ini_set('max_execution_time', 1800);
        $directionMapper = [
            'L' => 0,
            'R' => 1
        ];

        $mapData = [];

        $mapDirections = [];
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                continue;
            }

            if (empty($mapDirections)) {
                $mapDirections = str_split($row);
                continue;
            }
            [$mapName, $directions] = explode(' = ', $row);
            $mapData[$mapName] = array_combine(['L', 'R'], explode(', ', str_replace(['(', ')'], '',$directions)));
        }
        return $this->findAllEndPositions($mapDirections, $mapData);
    }

    private function findAllEndPositions(array $mapDirections, array $mapData): int
    {
        $startPositions = $this->findStartPositions($mapData);
        $currentPositions = $startPositions;
        $result = [];
        foreach ($currentPositions as $position) {
            $i = 0;
            $currentPosition = $position;
            $found = false;
            while (!$found) {
                foreach ($mapDirections as $direction) {
                    if ($this->allPositionsHasEnded([$currentPosition])) {

                        $found = true;
                        $result[] = $i;
                        break;
                    }
                    $i++;
                    $currentPosition = $mapData[$currentPosition][$direction];
                }
            }
        }

        return $this->LCM->lcmofn($result, count($result));
    }

    private function findStartPositions(array $mapData): array
    {
        $startPositions = [];
        foreach (array_keys($mapData) as $mapPosition) {
            if (str_ends_with($mapPosition, 'A')) {
                $startPositions[] = $mapPosition;
            }
        }

        return $startPositions;
    }

    private function allPositionsHasEnded(array $currentPositions): bool
    {
        foreach ($currentPositions as $mapPosition) {
            if (!str_ends_with($mapPosition, 'Z')) {
                return false;
            }
        }

        return true;
    }
}
