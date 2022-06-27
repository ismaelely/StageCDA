<?php

namespace App\Controller;

use App\Repository\ReviewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipeController extends AbstractController
{
    /**
     * @Route("/equipe", name="app_equipe")
     */
    public function index(ReviewsRepository $reviewsRepository): Response
    {
        return $this->render('equipe/index.html.twig', [
            'reviews' => $reviewsRepository->allReviews(),
        ]);
    }
}
