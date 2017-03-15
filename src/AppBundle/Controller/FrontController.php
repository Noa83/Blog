<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Article;


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

    public function articleAction(Article $article)
    {
        return $this->render('Front/article.html.twig', [
            'article' => $article
        ] );
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
