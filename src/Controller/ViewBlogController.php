<?php

namespace App\Controller;

use App\Entity\CommentsBlog;
use App\Form\CommentsBlogType;
use App\Repository\BlogRepository;
use App\Repository\CommentsBlogRepository;
use App\Repository\FormationsRepository;
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
                                      CommentsBlogRepository $commentsBlogRepository,
                                      FormationsRepository $formationsRepository,
                                      Request $request
                ): Response
    {

        #POUR OUVRUUR LE BLOG SUR LA PAGE AVEC L'ID #
        $blogs= $blogRepository->find($id);

        #POUR FORMULAIRE DE COMMENTAIRES#
        $blogComment = new CommentsBlog();
        $form = $this->createForm(CommentsBlogType::class, $blogComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            #ON SET DATE D'AUJOURD'HUI ET L'ETAT A 0#
            $blogComment->setDate(new \DateTimeImmutable('now'));
            $blogComment->setEtat("0");

            #SA SERT POUR QUE LE COMMENTAIRE OBTIEN L'ID DU BLOG#
            $id = $blogRepository->find($id);
            $blogComment->setBlog($id);

            $em->persist($blogComment);
            $em->flush();
        }

        return $this->render('view_blog/index.html.twig', [
            "blogs"=>$blogs,
            'allBlogs'=> $blogRepository -> findAll(),
            'comments' => $commentsBlogRepository ->findAll(),
            'other' => $blogRepository ->findAll(),
            'formations'=> $formationsRepository ->findAll(),
            'commentBlog' => $form->createView()

        ]);
    }
}
