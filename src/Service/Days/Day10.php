<?php

namespace App\Service\Days;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Day10 extends AbstractController
{
    public function __construct(public array $grid = [], public array $gridBorder = [])
    {
    }

    public function generatePart1($rows): string
    {
        // x = -
        // y = |
        $startPosition = [];
        $i = 0;
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            $this->grid[] = str_split($row);
            if (empty($startPosition) && in_array('S', $this->grid[$i], true)) {
                $startPosition = ['x' => $i, 'y' => array_search('S', $this->grid[$i], true)];
                $this->gridBorder[$startPosition['x'] . '-' . $startPosition['y']] = $startPosition['x'] . '-' . $startPosition['y'];
            }
            $i++;
        }

        return $this->findEndPosition($startPosition);
    }

    public function generatePart2($rows): string
    {
        // y = |
        $startPosition = [];
        $i = 0;
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            $this->grid[] = str_split($row);
            if (empty($startPosition) && in_array('S', $this->grid[$i], true)) {
                $startPosition = ['x' => $i, 'y' => array_search('S', $this->grid[$i], true)];
                $this->gridBorder[$startPosition['x'] . '-' . $startPosition['y']] = $startPosition['x'] . 'S' . $startPosition['y'];
            }
            $i++;
        }


        $this->findEndPosition($startPosition);
//        ksort($this->gridBorder);
//dump($this->gridBorder);
        $totalInloop = 0;
        $maxY = count($this->grid[0]);
        foreach ($this->grid as $x => $xValue) {
            $inloop = 0;
            $lastDirection = '';
            for ($y=0;$y<$maxY;$y++) {
                $key = $x . '-' . $y;
                if (isset($this->gridBorder[$key])) {
                    if ($xValue[$y] === '-') {
                        continue;
                    }
                    if ($xValue[$y] === '|') {
                        $lastDirection = '';
                        $inloop = $inloop === 0 ? 1 : 0;
                        continue;
                    }
                    if ($xValue[$y] === 'F') {
                        $lastDirection = 'F';
                        continue;
                    }
                    if ($xValue[$y] === 'L') {
                        $lastDirection = 'L';
                        continue;
                    }

                    if ($lastDirection === 'F') {
                        if ($xValue[$y] === '7') {
                            $lastDirection = '';
                            continue;
                        }
                        if ($xValue[$y] === 'J') {
                            $lastDirection = '';
                            $inloop = $inloop === 0 ? 1 : 0;
                            continue;
                        }
                    }
                    if ($lastDirection === 'L') {
                        if ($xValue[$y] === 'J') {
                            $lastDirection = '';
                            continue;
                        }
                        if ($xValue[$y] === '7') {
                            $lastDirection = '';
                            $inloop = $inloop === 0 ? 1 : 0;
                            continue;
                        }
                    }
                }
                if ($inloop === 1) {
                    dump($x . '<->' . $y);
                    $totalInloop++;
                }
            }
                // 7 F | J L
//                if (in_array($x . '-' . $y, $this->gridBorder, true)) {
//                    continue;
//                }
//
//                if (in_array($x . '|' . $y, $this->gridBorder, true)) {
//                    $lastDirection = '';
//                    $inloop = $inloop === 0 ? 1 : 0;
//                    continue;
//                }
//                if (in_array($x . 'F' . $y, $this->gridBorder, true)) {
//                    $lastDirection = 'F';
//                    continue;
//                }
//                if ($lastDirection === 'F') {
//                    if (in_array($x . '7' . $y, $this->gridBorder, true)) {
//                        $lastDirection = '';
//                        continue;
//                    }
//                    if (in_array($x . 'J' . $y, $this->gridBorder, true)) {
//                        $lastDirection = '';
//                        $inloop = $inloop === 0 ? 1 : 0;
//                        continue;
//                    }
//                }
//                if (in_array($x . 'L' . $y, $this->gridBorder, true)) {
//                    $lastDirection = 'L';
//                    continue;
//                }
//                if ($lastDirection === 'L') {
//                    if (in_array($x . 'J' . $y, $this->gridBorder, true)) {
//                        $lastDirection = '';
//                        continue;
//                    }
//                    if (in_array($x . '7' . $y, $this->gridBorder, true)) {
//                        $lastDirection = '';
//                        $inloop = $inloop === 0 ? 1 : 0;
//                        continue;
//                    }
//                }
//                if ($inloop === 1) {
//                    dump($x . '<->' . $y);
//                    $totalInloop++;
//                }

            dump('--------------');
        }
//dump($this->gridBorder);
//        dd($totalInloop);

        return $totalInloop;
    }

    private function findEndPosition(array $startPosition): int
    {
        $i = 1;
        $firstPositions = $this->findFirstPositions($startPosition);
        $position1 = $firstPositions[0];
        $position2 = $firstPositions[1];

        while ($position1['position'] !== $position2['position']) {
            $i++;
            $position1 = $this->getNextPosition($position1);
            $position2 = $this->getNextPosition($position2);
        }

        return $i;
    }


    private function walkUp($position): array
    {
        $x = $position['x'];
        $y = $position['y'];

        $this->gridBorder[$x-1 . '-' . $y] = $x-1 . $this->grid[$x-1][$y] . $y;
        $nextPositionData = ['position' => ['x' => $x-1, 'y' => $y]];
        if ($this->grid[$x-1][$y] === '7') {
            $nextPositionData['direction'] = 'left';
        } elseif ($this->grid[$x-1][$y] === '|') {
            $nextPositionData['direction'] = 'up';
        } elseif ($this->grid[$x-1][$y] === 'F') {
            $nextPositionData['direction'] = 'right';
        }

        return $nextPositionData;
    }

    private function walkRight($position): array
    {
        $x = $position['x'];
        $y = $position['y'];

        $this->gridBorder[$x . '-' . $y+1] = $x . $this->grid[$x][$y+1] . $y+1;
        $nextPositionData = ['position' => ['x' => $x, 'y' => $y+1]];
        if ($this->grid[$x][$y+1] === 'J') {
            $nextPositionData['direction'] = 'up';
        } elseif ($this->grid[$x][$y+1] === '-') {
            $nextPositionData['direction'] = 'right';
        } elseif ($this->grid[$x][$y+1] === '7') {
            $nextPositionData['direction'] = 'down';
        }

        return $nextPositionData;
    }

    private function walkDown($position): array
    {
        $x = $position['x'];
        $y = $position['y'];

        $this->gridBorder[$x+1 . '-' . $y] = $x+1 . $this->grid[$x + 1][$y] . $y;
        $nextPositionData = ['position' => ['x' => $x+1, 'y' => $y]];
        if ($this->grid[$x + 1][$y] === 'J') {
            $nextPositionData['direction'] = 'left';
        } elseif ($this->grid[$x + 1][$y] === '|') {
            $nextPositionData['direction'] = 'down';
        } elseif ($this->grid[$x + 1][$y] === 'L') {
            $nextPositionData['direction'] = 'right';
        }

        return $nextPositionData;
    }

    private function walkLeft($position): array
    {
        $x = $position['x'];
        $y = $position['y'];

        $this->gridBorder[$x . '-' . $y-1] = $x . $this->grid[$x][$y-1] . $y-1;
        $nextPositionData = ['position' => ['x' => $x, 'y' => $y-1]];
        if ($this->grid[$x][$y-1] === 'L') {
            $nextPositionData['direction'] = 'up';
        } elseif ($this->grid[$x][$y-1] === '-') {
            $nextPositionData['direction'] = 'left';
        } elseif ($this->grid[$x][$y-1] === 'F') {
            $nextPositionData['direction'] = 'down';
        }

        return $nextPositionData;
    }

    private function findFirstPositions(array $startPosition): array
    {
        $firstPositions = [];

        $x = $startPosition['x'];
        $y = $startPosition['y'];
        $up = false;
        $right = false;
        $down = false;
        $left = false;

        if ($x-1 >= 0 && in_array($this->grid[$x - 1][$y], ['7', '|', 'F'], true)) {
            $up = true;
            $firstPositions[] = $this->walkUp($startPosition);
        }
        if (count($this->grid[$x]) > $y+1 && in_array($this->grid[$x][$y + 1], ['J', '-', '7'], true)) {
            $right = true;
            $firstPositions[] = $this->walkRight($startPosition);
        }
        if (count($this->grid) > $x+1 && in_array($this->grid[$x + 1][$y], ['J', '|', 'L'], true)) {
            $down = true;
            $firstPositions[] = $this->walkDown($startPosition);
        }
        if ($y-1 >= 0 && in_array($this->grid[$x][$y - 1], ['L', '-', 'F'], true)) {
            $left = true;
            $firstPositions[] = $this->walkLeft($startPosition);
        }

        if ($up) {
            if ($right) {
                $this->grid[$x][$y] = 'L';
            } elseif ($down) {
                $this->grid[$x][$y] = '|';
            } elseif ($left) {
                $this->grid[$x][$y] = 'J';
            }
        } elseif ($right) {
            if ($down) {
                $this->grid[$x][$y] = 'F';
            } elseif ($left) {
                $this->grid[$x][$y] = '-';
            }
        } elseif ($down && $left) {
            $this->grid[$x][$y] = '7';
        }

        return $firstPositions;
    }

    private function getNextPosition(array $position): array
    {
        $nexPosition = [];
        if ($position['direction'] === 'up') {
            $nexPosition = $this->walkUp($position['position']);
        } elseif ($position['direction'] === 'right') {
            $nexPosition = $this->walkRight($position['position']);
        } elseif ($position['direction'] === 'down') {
            $nexPosition = $this->walkDown($position['position']);
        } elseif ($position['direction'] === 'left') {
            $nexPosition = $this->walkLeft($position['position']);
        }

        return $nexPosition;
    }
}
