<?php

namespace App\Service\Days;

class Day4
{
    public function generatePart1($rows): string
    {
        $totalPoints = 0;
        foreach ($rows as $row) {
            if ($row === '') {
                continue;
            }
            $row = trim(preg_replace('/\r+/', '', $row));

            $row = preg_replace('/\s+/', ' ',$row);
            $rowData = explode(': ', $row);

            $separateData = explode(' | ', $rowData[1]);
            $winningNrs = explode(' ', $separateData[0]);
            $myNrs = explode(' ', $separateData[1]);

            $matchingNrs = array_intersect($winningNrs, $myNrs);
            if (!empty($matchingNrs)) {
                $pointsToAdd = 2 ** (count($matchingNrs) - 1);
                $totalPoints += $pointsToAdd;
            }
        }
        
        return $totalPoints;
    }

    public function generatePart2($rows): string
    {
        $trackingArray = [];

        foreach ($rows as $row) {
            if ($row === '') {
                continue;
            }
            $row = trim(preg_replace('/\r+/', '', $row));
            $row = preg_replace('/\s+/', ' ',$row);
            $rowData = explode(': ', $row);
            $cardId = (int)(explode(' ', $rowData[0]))[1];
            $separateData = explode(' | ', $rowData[1]);
            $winningNrs = explode(' ', $separateData[0]);
            $myNrs = explode(' ', $separateData[1]);
            $matchingNrs = array_intersect($winningNrs, $myNrs);

            if (!isset($trackingArray[$cardId])) {
                $trackingArray[$cardId] = 1;
            } else {
                $trackingArray[$cardId]++;
            }

            for ($i=1, $iMax = count($matchingNrs); $i<= $iMax; $i++) {
                if (!isset($trackingArray[$cardId+$i])) {
                    $trackingArray[$cardId+$i] = $trackingArray[$cardId];
                }else {
                    $trackingArray[$cardId+$i] += $trackingArray[$cardId];
                }
            }
        }

        return array_sum($trackingArray);
    }
}
