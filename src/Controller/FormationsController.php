<?php

namespace App\Controller;

use App\Repository\FormationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationsController extends AbstractController
{
    /**
     * @Route("/formations", name="app_formations")
     */
    public function index(
        FormationsRepository $formationsRepository
    ): Response
    {



        return $this->render('formations/index.html.twig', [
            'formations' => $formationsRepository->allFormations(),
        ]);
    }
}
