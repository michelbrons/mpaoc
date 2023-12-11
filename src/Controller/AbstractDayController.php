<?php

namespace App\Controller;

use App\Form\DayType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AbstractDayController extends AbstractController
{
    public function getForm(Request $request): Form
    {
        $form = $this->createForm(DayType::class);

        $form->handleRequest($request);

        if (false === $form instanceof Form) {
            throw new \RuntimeException('Must be instance of Form');
        }

        return $form;
    }

    public function renderDayPage(int $day, string $title, string $result, Form $form): Response
    {
        return $this->render('day.html.twig', [
            'day_nr' => $day,
            'day_title' => $title,
            'result' => $result,
            'form' => $form,
        ]);
    }
}