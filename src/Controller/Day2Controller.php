<?php

namespace App\Controller;

use App\Form\DayType;
use App\Service\FileOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Day2Controller extends AbstractController
{
    #[Route('/day2', name: 'app_day2')]
    public function index(Request $request, FileOptions $fileOptions): Response
    {
        $result = '';
        $form = $this->createForm(DayType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $rows = $fileOptions->getDayInput($formData, 2);

            if ($formData['day_part'] === 1) {
                $result = $this->generatePart1($rows);
            } else {
                $result = $this->generatePart2($rows);
            }
        }

        return $this->render('day.html.twig', [
            'day_nr' => 2,
            'day_title' => 'Cube Conundrum',
            'result' => $result,
            'form' => $form,
        ]);
    }

    private function generatePart1($rows): string
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

    private function generatePart2($rows): string
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
