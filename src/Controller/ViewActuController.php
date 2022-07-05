<?php

namespace App\Controller;

use App\Entity\CommentsActu;
use App\Form\CommentsActuType;
use App\Repository\ActualitesRepository;
use App\Repository\BlogRepository;
use App\Repository\CommentsActuRepository;
use App\Repository\FormationsRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ViewBlogController
 * @package App\Controller
 * @Route("/actualites", name="actualites_")
 */

class ViewActuController extends AbstractController
{
    /**
     * @Route("/{id}", name="app_view_actualites")
     */
    public function index(int $id,
                          ActualitesRepository $actuRepository,
                          CommentsActuRepository $commentsActuRepository,
                          FormationsRepository $formationsRepository,
                          Request $request
    ): Response
    {
        $actus= $actuRepository->find($id);

        #POUR FORMULAIRE DE COMMENTAIRES#
        $actuComment = new CommentsActu();
        $form = $this->createForm(CommentsActuType::class, $actuComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            #ON SET DATE D'AUJOURD'HUI ET L'ETAT A 0#
            $actuComment->setDate(new \DateTimeImmutable('now'));
            $actuComment->setEtat("0");

            #SA SERT POUR QUE LE COMMENTAIRE OBTIEN L'ID DU BLOG#
            $id = $actuRepository->find($id);
            $actuComment->setActu($id);

            $em->persist($actuComment);
            $em->flush();
        }


        return $this->render('view_actu/index.html.twig', [
            "actus" => $actus,
            'allActus'=> $actuRepository -> findAll(),
            'comments' => $commentsActuRepository ->findAll(),
            'formations'=> $formationsRepository ->findAll(),
            'other' => $actuRepository ->findAll(),
            'commentBlog' => $form->createView()
        ]);
    }
}
