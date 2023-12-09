<?php

namespace App\Service\Days;

class Day6
{
    public function generatePart1($rows): string
    {
        $timeStringData = [];
        $distanceStringData = [];

        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));

            if (empty($row)) {
                break;
            }
            if (empty($timeStringData)) {
                $timeStringData = explode(': ', preg_replace('/\s+/', ' ',$row));
            } else {
                $distanceStringData = explode(': ', preg_replace('/\s+/', ' ',$row));
            }
        }

        $timeArray = explode (' ', $timeStringData[1]);
        $distanceArray = explode (' ', $distanceStringData[1]);

        return $this->getNumberOfWays($timeArray, $distanceArray);
    }

    private function getNumberOfWays($timeArray, $distanceArray): int
    {
        $result = 1;
        foreach ($timeArray as $key => $time) {
            $halftime = (int)$time/2;
            $i = (int)floor($halftime);
            $totalTimeToPush = 0;

            while ($i * ((int)$time-$i) > (int)$distanceArray[$key]) {
                $totalTimeToPush++;
                --$i;
            }
            $totalTimeToPush *= 2;
            if ($time%2 === 0) {
                $totalTimeToPush--;
            }
            $result *= $totalTimeToPush;
        }

        return $result;
    }

    public function generatePart2($rows): string
    {
        $timeStringData = [];
        $distanceStringData = [];

        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));

            if (empty($row)) {
                break;
            }
            if (empty($timeStringData)) {
                $timeStringData = explode(':', preg_replace('/\s+/', '',$row));
            } else {
                $distanceStringData = explode(':', preg_replace('/\s+/', '',$row));
            }
        }

        $timeArray = explode (' ', $timeStringData[1]);
        $distanceArray = explode (' ', $distanceStringData[1]);

        return $this->getNumberOfWays($timeArray, $distanceArray);
    }
}
