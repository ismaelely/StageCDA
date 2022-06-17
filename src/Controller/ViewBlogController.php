<?php

namespace App\Controller;

use App\Entity\CommentsBlog;
use App\Form\CommentsBlogType;
use App\Repository\BlogRepository;
use App\Repository\CommentsBlogRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ViewBlogController
 * @package App\Controller
 * @Route("/blogs", name="blogs_")
 */


class ViewBlogController extends AbstractController
{
    /**
     * @Route("/{id}", name="app_view_blog")
     */
                public function index(int $id,
                                      BlogRepository $blogRepository,
                                      UserRepository $userRepository,
                                      CommentsBlogRepository $commentsBlogRepository,
                                      Request $request
                ): Response
    {
        $blogs= $blogRepository->find($id);

        $blogComment = new CommentsBlog();
        $form = $this->createForm(CommentsBlogType::class, $blogComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $blogComment->setDate(new \DateTimeImmutable('now'));


            $em->persist($blogComment);
            $em->flush();
        }




        return $this->render('view_blog/index.html.twig', [
            "blogs"=>$blogs,
            'user' => $userRepository ->find($id),
            'comments' => $commentsBlogRepository ->findAll(),
            'other' => $blogRepository ->findAll(),
            'commentBlog' => $form->createView()

        ]);
    }
}
