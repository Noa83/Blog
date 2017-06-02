<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


class BackLateralController extends Controller
{
    /**
     * @Route("/auteur/numberOfPublished", name="numberOfPublished")
     */
    public function getNumberOfPublished()
    {
        return new Response($this->get('number_of_articles')->getNumberOfArticles($this->getDoctrine()->getRepository('AppBundle:Article')->getArticlesList()));
    }

    /**
     * @Route("auteur/numberOfUnpublished", name="numberOfUnpublished")
     */
    public function getNumberOfUnpublished()
    {
        return new Response($this->get('number_of_articles')->getNumberOfArticles($this->getDoctrine()->getRepository('AppBundle:Article')->getUnpublishedArticlesList()));
    }
}
