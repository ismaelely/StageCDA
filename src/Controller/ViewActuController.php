<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewActuController extends AbstractController
{
    /**
     * @Route("/actualites/vue", name="app_view_actu")
     */
    public function index(): Response
    {
        return $this->render('view_actu/index.html.twig', [
            'controller_name' => 'ViewActuController',
        ]);
    }
}
