<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BrouillonArticleController extends Controller
{
    /**
     * @Security("has_role('ROLE_AUTHOR')")
     *
     * @Route("/auteur/brouillons", name="brouillons")
     */
    public function brouillonsAction()
    {
        $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');
        $unpublishedArticlesList =  $articleRepository->getUnpublishedArticlesList();

        return $this->render('Brouillons/brouillons.html.twig', [
            'unpublishedArticlesList' => $unpublishedArticlesList
        ]);
    }
}