<?php

namespace App\Controller;

use App\Repository\ActualitesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualitesController extends AbstractController
{
    /**
     * @Route("/actualites", name="app_actualites")
     */
    public function index(
        ActualitesRepository $actualitesRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $data = $actualitesRepository->findAll();

        $actualites = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            9
        );


        return $this->render('actualites/index.html.twig', [
            'actualites' => $actualites,
        ]);
    }
}
