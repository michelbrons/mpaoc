<?php

namespace App\Controller;

use App\Form\DayType;
use App\Service\Tools\FileOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AbstractDayController extends AbstractController
{
    public function renderDayPage(Request $request, FileOptions $fileOptions, mixed $dayService, $day, $title): Response
    {
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
        } else {
            $result = '';
        }

        return $this->render('day.html.twig', [
            'day_nr' => $day,
            'day_title' => $title,
            'result' => $result,
            'form' => $form,
        ]);
    }
}