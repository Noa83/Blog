<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BackLateralController extends Controller
{

    public function getNumberOfArticlesAction()
    {
        $numberOfPublished = count($this->getDoctrine()->getRepository('AppBundle:Article')->getPublishedArticlesList());
        $numberOfUnpublished = count($this->getDoctrine()->getRepository('AppBundle:Article')->getUnpublishedArticlesList());
        $numberOfSignaled = count($this->getDoctrine()->getRepository('AppBundle:Comment')->getSignaledComments());
        return $this->render(
            ':Basics_Components:backLateral.html.twig',[
                'numberOfPublished' => $numberOfPublished,
                'numberOfUnpublished' => $numberOfUnpublished,
                'numberOfSignaled' => $numberOfSignaled
            ]);
    }

}
