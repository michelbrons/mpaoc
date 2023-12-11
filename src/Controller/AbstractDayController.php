<?php

namespace App\Controller;

use App\Form\DayType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AbstractDayController extends AbstractController
{
    public function getForm(Request $request): ?array
    {
        $form = $this->createForm(DayType::class);

        $form->handleRequest($request);
        if (!$form->isSubmitted() || !$form->isValid()) {
            return null;
        }

        return $form->getData();
    }

    public function renderDayPage($day, $title, $result, $form): Response
    {
        return $this->render('day.html.twig', [
            'day_nr' => $day,
            'day_title' => $title,
            'result' => $result,
            'form' => $form,
        ]);
    }
}