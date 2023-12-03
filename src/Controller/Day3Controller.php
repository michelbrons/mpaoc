<?php

namespace App\Controller;

use App\Form\DayType;
use App\Service\FileOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Day3Controller extends AbstractController
{
    #[Route('/day3', name: 'app_day3')]
    public function index(Request $request, FileOptions $fileOptions): Response
    {
        $day = 3;
        $result = '';
        $form = $this->createForm(DayType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $rows = $fileOptions->getDayInput($formData, $day);

            if ($formData['day_part'] === 1) {
                $result = $this->generatePart1($rows);
            } else {
                $result = $this->generatePart2($rows);
            }
        }

        return $this->render('day.html.twig', [
            'day_nr' => $day,
            'day_title' => 'Gear Ratios',
            'result' => $result,
            'form' => $form,
        ]);
    }

    private function generatePart1($rows): string
    {
        $arrayInput = $this->makeArrayInput($rows);
        $numbersToCount = $this->listNumbersToCount($arrayInput);

        return array_sum($numbersToCount);
    }

    private function generatePart2($rows): string
    {
        $arrayInput = $this->makeArrayInput($rows);
        $numbersToCount = $this->listNumbersToCountByStar($arrayInput);

        return array_sum($numbersToCount);
    }

    private function makeArrayInput($input): array
    {
        $outputArray = [];
        $i = 0;
        foreach ($input as $row) {
            $outputArray[$i] = str_split($row);
            $i++;
        }

        return $outputArray;
    }

    private function listNumbersToCount(array $arrayInput): array
    {
        $numbersToCount = [];

        foreach ($arrayInput as $y => $yValue) {
            $number = '';
            $isCounting = false;

            foreach ($yValue as $i => $iValue) {
                if (is_numeric($iValue)) {
                    if (!$isCounting) {
                        $isCounting = $this->checkCounting($y, $i, $arrayInput);
                    }
                    $number .= $iValue;
                    if (!isset($yValue[($i + 1)]) || !is_numeric($yValue[($i + 1)])) {
                        if ($isCounting) {
                            $numbersToCount[] = $number;
                        }
                        $isCounting = false;
                        $number = '';
                    }
                }
            }
        }

        return $numbersToCount;
    }

    private function checkCounting(int $y, int $i, array $arrayInput): bool
    {
        if ($y > 0) {
            if (($i > 0) && $this->checkFieldToCount($arrayInput[($y - 1)][($i - 1)])) {
                return true;
            }
            if ($this->checkFieldToCount($arrayInput[($y-1)][($i)])) {
                return true;
            }

            if ((($i + 1) < count($arrayInput[$y])) && $this->checkFieldToCount($arrayInput[($y - 1)][($i + 1)])) {
                return true;
            }
        }
        if (($i > 0) && $this->checkFieldToCount($arrayInput[($y)][($i - 1)])) {
            return true;
        }
        if ((($i + 1) < count($arrayInput[$y])) && $this->checkFieldToCount($arrayInput[($y)][($i + 1)])) {
            return true;
        }
        if (($y+1) < count($arrayInput)) {
            if (($i > 0) && $this->checkFieldToCount($arrayInput[($y + 1)][($i - 1)])) {
                return true;
            }
            if ($this->checkFieldToCount($arrayInput[($y + 1)][($i)])) {
                return true;
            }

            if ((($i + 1) < count($arrayInput[$y])) && $this->checkFieldToCount($arrayInput[($y + 1)][($i + 1)])) {
                return true;
            }
        }
        return false;
    }

    private function checkFieldToCount($field): bool
    {
        return !is_numeric($field) && $field !== '.';
    }

    private function listNumbersToCountByStar(array $arrayInput): array
    {
        $numbersToCount = [];

        foreach ($arrayInput as $y => $yValue) {
            foreach ($yValue as $i => $iValue) {
                if ($iValue === '*') {
                    $numbers = $this->getNumbers($y, $i, $arrayInput);
                    if (count($numbers) === 2) {
                        dump($numbers);
                        $numbersToCount[] = $numbers[0] * $numbers[1];
                    }
                }
            }
        }

        return $numbersToCount;
    }

    private function getNumbers(int $y, int $i, array $arrayInput): array
    {
        $numbers = [];

        if (isset($arrayInput[($y - 1)][($i)]) && !is_numeric($arrayInput[($y - 1)][($i)])) {
            if (isset($arrayInput[($y - 1)][($i - 1)]) && is_numeric($arrayInput[($y - 1)][($i - 1)])) {
                $numbers[] = $this->getWholeNumber($y-1, $i-1, $arrayInput);
            }
            if (isset($arrayInput[($y - 1)][($i + 1)]) && is_numeric($arrayInput[($y - 1)][($i + 1)])) {
                $numbers[] = $this->getWholeNumber($y-1, $i+1, $arrayInput);
            }
        } else {
            if (isset($arrayInput[($y - 1)][($i)]) && is_numeric($arrayInput[($y - 1)][$i])) {
                $numbers[] = $this->getWholeNumber($y-1, $i, $arrayInput);
            }
        }

        if (isset($arrayInput[($y)][($i-1)]) && is_numeric($arrayInput[($y)][($i-1)])) {
            $numbers[] = $this->getWholeNumber($y, $i-1, $arrayInput);
        }
        if (isset($arrayInput[($y)][($i+1)]) && is_numeric($arrayInput[($y)][($i+1)])) {
            $numbers[] = $this->getWholeNumber($y, $i+1, $arrayInput);
        }

        if (isset($arrayInput[($y + 1)][($i)]) && !is_numeric($arrayInput[($y + 1)][($i)])) {
            if (isset($arrayInput[($y + 1)][($i - 1)]) && is_numeric($arrayInput[($y + 1)][($i - 1)])) {
                $numbers[] = $this->getWholeNumber($y+1, $i-1, $arrayInput);
            }
            if (isset($arrayInput[($y + 1)][($i + 1)]) && is_numeric($arrayInput[($y + 1)][($i + 1)])) {
                $numbers[] = $this->getWholeNumber($y+1, $i+1, $arrayInput);
            }
        } else {
            if (isset($arrayInput[($y + 1)][($i)]) && is_numeric($arrayInput[($y + 1)][$i])) {
                $numbers[] = $this->getWholeNumber($y+1, $i, $arrayInput);
            }
        }

        return $numbers;
    }

    private function getWholeNumber(int $y, int $i, array $arrayInput): int
    {
        $number = $arrayInput[$y][$i];
        for ($index = $i-1; isset($arrayInput[$y][$index]); $index--) {
            if (is_numeric($arrayInput[$y][$index])) {
                $number = $arrayInput[$y][$index] . $number;
            } else {
                break;
            }
        }
        for ($index = $i+1; isset($arrayInput[$y][$index]); $index++) {
            if (is_numeric($arrayInput[$y][$index])) {
                $number .= $arrayInput[$y][$index];
            } else {
                break;
            }
        }

        return $number;
    }
}
