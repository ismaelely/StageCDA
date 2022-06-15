<?php

namespace App\Controller;

use App\Repository\FAQRepository;
use App\Repository\FormationsRepository;
use App\Repository\ReviewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_main")
     */
    public function index(ReviewsRepository $reviewsRepository, FormationsRepository $formationsRepository, FAQRepository $FAQRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'reviews' => $reviewsRepository->allReviews(),
            'formations' => $formationsRepository->allFormations(),
            'FAQs' => $FAQRepository->allFAQs(),
        ]);
    }
}
