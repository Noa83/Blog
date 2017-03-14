<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class FrontController extends Controller
{

    public function indexAction()
    {
        $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');
        $articlesList =  $articleRepository->getArticlesList();
        dump($articlesList);

        return $this->render('Front/index.html.twig', [
            'articlesList' => $articlesList
        ]);
    }

    public function articleAction($id)
    {
        return $this->render('Front/article.html.twig');
    }

    public function contactAction()
    {
        return $this->render('Front/contact.html.twig');
    }

    public function auteurAction()
    {
        return $this->render('Front/auteur.html.twig');
    }
}
