<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemarchePedadogiqueController extends AbstractController
{
    /**
     * @Route("/DemarchePedadogique", name="app_demarche_pedadogique")
     */
    public function index(): Response
    {
        return $this->render('demarchePedadogique/index.html.twig', [
            'controller_name' => 'DemarchePedadogiqueController',
        ]);
    }
}
