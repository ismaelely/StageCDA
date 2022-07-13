<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FinancementController extends AbstractController
{
    /**
     * @Route("/financement", name="app_financement")
     */
    public function index(): Response
    {
        return $this->render('financement/index.html.twig', [
            'controller_name' => 'FinancementController',
        ]);
    }
}
