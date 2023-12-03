<?php

namespace App\Controller;

use App\Form\DayType;
use App\Service\Day3;
use App\Service\FileOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Day3Controller extends AbstractController
{
    #[Route('/day3', name: 'app_day3')]
    public function index(Request $request, FileOptions $fileOptions, Day3 $day3Service): Response
    {
        $day = 3;
        $result = '';
        $form = $this->createForm(DayType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $rows = $fileOptions->getDayInput($formData, $day);

            if ($formData['day_part'] === 1) {
                $result = $day3Service->generatePart1($rows);
            } else {
                $result = $day3Service->generatePart2($rows);
            }
        }

        return $this->render('day.html.twig', [
            'day_nr' => $day,
            'day_title' => 'Gear Ratios',
            'result' => $result,
            'form' => $form,
        ]);
    }
}
