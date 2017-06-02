<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class AproposAuteurController extends Controller
{
    /**
     * @Route("/a_propos", name="auteur")
     */
    public function auteurAction()
    {
        return $this->render('A_Propos/auteur.html.twig');
    }
}