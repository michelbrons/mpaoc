<?php

namespace App\Service\Days;

class Day5
{
    public function generatePart1($rows): string
    {
        $seedLocations = [];
        $convertArray = [];
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (str_starts_with($row, 'seeds:')) {
                $seedLocations = explode(' ', str_replace('seeds: ', '', $row));
                continue;
            }
            if (empty($row)) {
                continue;
            }
            if (str_ends_with($row, 'map:')) {
                if (!empty($convertArray)) {
                    $seedLocations = $this->recalculateLocations($seedLocations, $convertArray);
                    $convertArray = [];
                }
            } else {
                $convertArray[] = explode(' ', $row);
            }
        }
        $seedLocations = $this->recalculateLocations($seedLocations, $convertArray);

        return min($seedLocations);
    }

    private function recalculateLocations(array $seedLocations, array $convertArray): array
    {
        foreach ($seedLocations as $seedLocationKey => $seedLocation) {
            foreach ($convertArray as [$nextStartValue, $optionStartNr, $optionRangeLength]) {
                if (($optionStartNr <= $seedLocation) && ($seedLocation <= ($optionStartNr + $optionRangeLength))) {
                    $seedLocations[$seedLocationKey] = $seedLocation + ($nextStartValue - $optionStartNr);
                    break;
                }
            }
        }

        return $seedLocations;
    }

    public function generatePart2($rows): string
    {
        $seedLocations = [];
        $convertArray = [];
        $i = 0;
        foreach ($rows as $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (str_starts_with($row, 'seeds:')) {
                $seedRawLocations = explode(' ', str_replace('seeds: ', '', $row));
                $range = [];
                foreach ($seedRawLocations as $key => $location) {
                    $range[] = $location;
                    if (($key % 2) === 1) {
                        $seedLocations[] = [(int)$range[0], ($range[0] + $range[1])];
                        $range = [];
                    }
                }
                continue;
            }
            if (empty($row)) {
                continue;
            }
            if (str_ends_with($row, 'map:')) {
                if (!empty($convertArray[$i])) {
                    $i++;
                    $convertArray[$i] = [];
                }
            } else {
                $convertArray[$i][] = explode(' ', $row);
            }
        }

        $lastSeedLocations = $this->calculateSeedsLocation($seedLocations, $convertArray);
        $lowestNumber = null;
        foreach ($lastSeedLocations as $row) {
            $minRowValue = min($row);
            if (null === $lowestNumber || $minRowValue < $lowestNumber) {
                $lowestNumber = $minRowValue;
            }
        }

        return $lowestNumber;
    }

    private function calculateSeedsLocation(array $seedLocations, array $convertArray): array
    {
        foreach ($convertArray as $convertLevel) {
            $newSeedLocations = [];
            while(!empty($seedLocations)) {
                [$seedLocationStartNr, $seedLocationEndtNr] = array_shift($seedLocations);
                $found = false;
                foreach ($convertLevel as [$nextStartValue, $optionStartNr, $optionRangeLength]) {
                    $optionEndNr = $optionStartNr+$optionRangeLength;
                    if ($seedLocationStartNr > (int)$optionStartNr && $seedLocationStartNr < $optionEndNr) {
                        $newStartLocation = ($seedLocationStartNr - $optionStartNr) + $nextStartValue;
                        if ($seedLocationEndtNr > $optionEndNr) {
                            $newEndLocation = $nextStartValue+$optionRangeLength;
                            $seedLocations[] = [$optionEndNr+1, $seedLocationEndtNr];
                        } else {
                            $newEndLocation = ($seedLocationEndtNr - $optionStartNr) + $nextStartValue;
                        }
                        $newSeedLocations[] = [$newStartLocation, $newEndLocation];
                        $found = true;
                        break;
                    }
                    if ($seedLocationEndtNr > (int)$optionStartNr && $seedLocationEndtNr < $optionEndNr) {
                        $newEndLocation = ($seedLocationEndtNr - $optionStartNr) + $nextStartValue;
                        if ($seedLocationStartNr < $optionStartNr) {
                            $newStartLocation = (int)$nextStartValue;
                            $seedLocations[] = [$seedLocationStartNr, $optionStartNr-1];
                        } else {
                            $newStartLocation = ($seedLocationStartNr - $optionStartNr) + $nextStartValue;
                        }
                        $newSeedLocations[] = [$newStartLocation, $newEndLocation];
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $newSeedLocations[] = [$seedLocationStartNr, $seedLocationEndtNr];
                }
            }
            $seedLocations = $newSeedLocations;
        }

        return $seedLocations;
    }
}
