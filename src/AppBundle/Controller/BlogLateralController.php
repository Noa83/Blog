<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class BlogLateralController extends Controller
{

    public function getChaptersListAction()
    {
        $chaptersList = $this->getDoctrine()->getRepository('AppBundle:Article')->getArticlesList();
        return $this->render(
            '::blogLateral.html.twig',[
            'chaptersList' => $chaptersList
        ]);
    }

}
