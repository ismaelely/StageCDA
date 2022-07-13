<?php

namespace App\Controller;

use App\Entity\Actualites;
use App\Entity\Reviews;
use App\Form\CommentsFormationsType;
use App\Repository\ActualitesRepository;
use App\Repository\BlogRepository;
use App\Repository\FormationsRepository;
use App\Repository\ReviewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ViewFormationsController
 * @package App\Controller
 * @Route("/formation", name="formation_")
 */

class ViewFormationsController extends AbstractController
{
    /**
     * @Route("/{id}", name="app_view_formations")
     */
    public function index(int $id,
                          ActualitesRepository $actualitesRepository,
                          BlogRepository $blogRepository,
                          FormationsRepository $formationsRepository,
                          ReviewsRepository $reviewsRepository,
                          Request $request
    ): Response
    {
        $formation= $formationsRepository->find($id);

        $formComment= new Reviews();
        $form = $this->createForm(CommentsFormationsType::class, $formComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            #ON SET DATE D'AUJOURD'HUI ET L'ETAT A 0#
            $formComment->setDate(new \DateTime('now'));

            $formComment->setNote(1);
            $formComment->setEtat("0");

            #SA SERT POUR QUE LE COMMENTAIRE OBTIEN L'ID DU BLOG#
            $id = $formationsRepository->find($id);
            $formComment->setParent($id);

            $em->persist($formComment);
            $em->flush();
        }

        return $this->render('view_formations/index.html.twig', [
            "formations" => $formation,
            'comments' => $reviewsRepository ->findAll(),
            'allFormations' => $formationsRepository ->findAll(),
            'ActuLastThree' => $actualitesRepository ->findBy([],['id'=>'DESC'],3),
            'BlogLastThree' => $blogRepository ->findBy([],['id'=>'DESC'],3),
            'commentFormation' => $form->createView()
        ]);
    }
}





















