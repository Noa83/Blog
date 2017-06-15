<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class AboutTheAuthorController extends Controller
{
    /**
     * @Route("/about", name="author")
     */
    public function authorAction()
    {
        return $this->render('About_the_Author/author.html.twig');
    }
}