<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BackLateralController extends Controller
{

    public function getNumberOfArticlesAction()
    {
        $numberOfPublished = $this->get('number_of_something')->getNumberOfSomething($this->getDoctrine()->getRepository('AppBundle:Article')->getArticlesList());
        $numberOfUnpublished = $this->get('number_of_something')->getNumberOfSomething($this->getDoctrine()->getRepository('AppBundle:Article')->getUnpublishedArticlesList());
        $numberOfSignaled = $this->get('number_of_something')->getNumberOfSomething($this->getDoctrine()->getRepository('AppBundle:Comment')->getSignaledComments());
        return $this->render(
            '::backLateral.html.twig',[
                'numberOfPublished' => $numberOfPublished,
                'numberOfUnpublished' => $numberOfUnpublished,
                'numberOfSignaled' => $numberOfSignaled
            ]);
    }

}
