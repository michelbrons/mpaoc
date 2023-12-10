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
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day2', name: 'app_day2')]
    public function day2(Request $request, FileOptions $fileOptions, Day2 $dayService): Response
    {
        $day = 2;
        $title = 'Cube Conundrum';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day3', name: 'app_day3')]
    public function day3(Request $request, FileOptions $fileOptions, Day3 $dayService): Response
    {
        $day = 3;
        $title = 'Gear Ratios';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day4', name: 'app_day4')]
    public function day4(Request $request, FileOptions $fileOptions, Day4 $dayService): Response
    {
        $day = 4;
        $title = 'Scratchcards';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day5', name: 'app_day5')]
    public function day5(Request $request, FileOptions $fileOptions, Day5 $dayService): Response
    {
        $day = 5;
        $title = 'If You Give A Seed A Fertilizer';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day6', name: 'app_day6')]
    public function day6(Request $request, FileOptions $fileOptions, Day6 $dayService): Response
    {
        $day = 6;
        $title = 'Wait For It';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day7', name: 'app_day7')]
    public function day7(Request $request, FileOptions $fileOptions, Day7 $dayService): Response
    {
        $day = 7;
        $title = 'Camel Cards';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day8', name: 'app_day8')]
    public function day8(Request $request, FileOptions $fileOptions, Day8 $dayService): Response
    {
        $day = 8;
        $title = 'Haunted Wasteland';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day9', name: 'app_day9')]
    public function day9(Request $request, FileOptions $fileOptions, Day9 $dayService): Response
    {
        $day = 9;
        $title = 'Mirage Maintenance';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day10', name: 'app_day10')]
    public function day10(Request $request, FileOptions $fileOptions, Day10 $dayService): Response
    {
        $day = 10;
        $title = 'Pipe Maze';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day11', name: 'app_day11')]
    public function day11(Request $request, FileOptions $fileOptions, Day11 $dayService): Response
    {
        $day = 11;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day12', name: 'app_day12')]
    public function day12(Request $request, FileOptions $fileOptions, Day12 $dayService): Response
    {
        $day = 12;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day13', name: 'app_day13')]
    public function day13(Request $request, FileOptions $fileOptions, Day13 $dayService): Response
    {
        $day = 13;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day14', name: 'app_day14')]
    public function day14(Request $request, FileOptions $fileOptions, Day14 $dayService): Response
    {
        $day = 14;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day15', name: 'app_day15')]
    public function day15(Request $request, FileOptions $fileOptions, Day15 $dayService): Response
    {
        $day = 15;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day16', name: 'app_day16')]
    public function day16(Request $request, FileOptions $fileOptions, Day16 $dayService): Response
    {
        $day = 16;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day17', name: 'app_day17')]
    public function day17(Request $request, FileOptions $fileOptions, Day17 $dayService): Response
    {
        $day = 17;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day18', name: 'app_day18')]
    public function day18(Request $request, FileOptions $fileOptions, Day18 $dayService): Response
    {
        $day = 18;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day19', name: 'app_day19')]
    public function day19(Request $request, FileOptions $fileOptions, Day19 $dayService): Response
    {
        $day = 19;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day20', name: 'app_day20')]
    public function day20(Request $request, FileOptions $fileOptions, Day20 $dayService): Response
    {
        $day = 20;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day21', name: 'app_day21')]
    public function day21(Request $request, FileOptions $fileOptions, Day21 $dayService): Response
    {
        $day = 21;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day22', name: 'app_day22')]
    public function day22(Request $request, FileOptions $fileOptions, Day22 $dayService): Response
    {
        $day = 22;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day23', name: 'app_day23')]
    public function day23(Request $request, FileOptions $fileOptions, Day23 $dayService): Response
    {
        $day = 23;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day24', name: 'app_day24')]
    public function day24(Request $request, FileOptions $fileOptions, Day24 $dayService): Response
    {
        $day = 24;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
    #[Route('/day25', name: 'app_day25')]
    public function day25(Request $request, FileOptions $fileOptions, Day25 $dayService): Response
    {
        $day = 25;
        $title = '???';
        return $this->renderDayPage($request, $fileOptions, $dayService, $day, $title);
    }
}
