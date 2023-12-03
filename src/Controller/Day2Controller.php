<?php

namespace App\Controller;

use App\Form\DayType;
use App\Service\Day2;
use App\Service\FileOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Day2Controller extends AbstractController
{
    #[Route('/day2', name: 'app_day2')]
    public function index(Request $request, FileOptions $fileOptions, Day2 $day2Service): Response
    {
        $day = 2;
        $result = '';
        $form = $this->createForm(DayType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $rows = $fileOptions->getDayInput($formData, $day);

            if ($formData['day_part'] === 1) {
                $result = $day2Service->generatePart1($rows);
            } else {
                $result = $day2Service->generatePart2($rows);
            }
        }

        return $this->render('day.html.twig', [
            'day_nr' => $day,
            'day_title' => 'Cube Conundrum',
            'result' => $result,
            'form' => $form,
        ]);
    }
}
