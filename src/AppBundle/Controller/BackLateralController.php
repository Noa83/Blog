<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BackLateralController extends Controller
{

    public function getNumberOfArticlesAction()
    {
        $numberOfPublished = $this->get('number_of_articles')->getNumberOfArticles($this->getDoctrine()->getRepository('AppBundle:Article')->getArticlesList());
        $numberOfUnpublished = $this->get('number_of_articles')->getNumberOfArticles($this->getDoctrine()->getRepository('AppBundle:Article')->getUnpublishedArticlesList());
        dump($numberOfPublished);
        return $this->render(
            '::backLateral.html.twig',[
                'numberOfPublished' => $numberOfPublished,
                'numberOfUnpublished' => $numberOfUnpublished
            ]);
    }

}
