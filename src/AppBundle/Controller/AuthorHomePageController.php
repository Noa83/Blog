<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AuthorHomePageController extends Controller
{
    /**
     * @Security("has_role('ROLE_AUTHOR')")
     *
     * @Route("/author/", name="author_home_page")
     */
    public function indexBackAction()
    {
        $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');
        $articlesList =  $articleRepository->getPublishedArticlesList();

        return $this->render('Author_home_page/index_author_home.html.twig', [
            'articlesList' => $articlesList
        ]);
    }
}