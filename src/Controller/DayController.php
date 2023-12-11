<?php

namespace App\Controller;

use App\Service\Days\Day1;
use App\Service\Days\Day10;
use App\Service\Days\Day11;
use App\Service\Days\Day12;
use App\Service\Days\Day13;
use App\Service\Days\Day14;
use App\Service\Days\Day15;
use App\Service\Days\Day16;
use App\Service\Days\Day17;
use App\Service\Days\Day18;
use App\Service\Days\Day19;
use App\Service\Days\Day2;
use App\Service\Days\Day20;
use App\Service\Days\Day21;
use App\Service\Days\Day22;
use App\Service\Days\Day23;
use App\Service\Days\Day24;
use App\Service\Days\Day25;
use App\Service\Days\Day3;
use App\Service\Days\Day4;
use App\Service\Days\Day5;
use App\Service\Days\Day6;
use App\Service\Days\Day7;
use App\Service\Days\Day8;
use App\Service\Days\Day9;
use App\Service\Tools\FileOptions;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DayController extends AbstractDayController
{
    #[Route('/day1', name: 'app_day1')]
    public function day1(Request $request, FileOptions $fileOptions, Day1 $dayService): Response
    {
        $day = 1;
        $title = 'Trebuchet?!';
        $form = $this->getForm($request);
        $inputRows = $fileOptions->getDayInput($form, $day);
        $result = $dayService->generate($inputRows, $form['day_part']);

        return $this->renderDayPage($day, $title, $result, $form);
    }
}
