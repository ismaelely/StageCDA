<?php

namespace App\Controller;

use App\Repository\BlogRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blogs", name="app_blog")
     */
    public function index(
        BlogRepository $blogRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $data = $blogRepository->findAll();

        $blogs = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            8
        );


        return $this->render('blog/index.html.twig', [
            'blogs' => $blogs,
        ]);
    }
}
