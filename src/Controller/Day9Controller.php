<?php

namespace App\Controller;

use App\Form\DayType;
use App\Service\Day9;
use App\Service\FileOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Day9Controller extends AbstractController
{
    #[Route('/day9', name: 'app_day9')]
    public function index(Request $request, FileOptions $fileOptions, Day9 $dayService): Response
    {
        $day = 9;
        $result = '';
        $form = $this->createForm(DayType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $rows = $fileOptions->getDayInput($formData, $day);

            if ($formData['day_part'] === 1) {
                $result = $dayService->generatePart1($rows);
            } else {
                $result = $dayService->generatePart2($rows);
            }
        }

        return $this->render('day.html.twig', [
            'day_nr' => $day,
            'day_title' => 'Mirage Maintenance',
            'result' => $result,
            'form' => $form,
        ]);
    }
}
