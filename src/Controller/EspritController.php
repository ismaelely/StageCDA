<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EspritController extends AbstractController
{
    /**
     * @Route("/esprit", name="app_esprit")
     */
    public function index(): Response
    {
        return $this->render('esprit/index.html.twig', [
            'controller_name' => 'EspritController',
        ]);
    }
}
