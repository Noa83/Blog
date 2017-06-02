<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class HomeController extends Controller
{

    /**
     * @Route("/", name="home_page")
     */
    public function indexAction()
    {
        $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');
        $articlesList =  $articleRepository->getArticlesList();


        return $this->render('Home/index.html.twig', [
            'articlesList' => $articlesList
        ]);
    }
}
