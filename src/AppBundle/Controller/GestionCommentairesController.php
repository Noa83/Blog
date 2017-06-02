<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GestionCommentairesController extends Controller
{
    /**
     * @Security("has_role('ROLE_AUTHOR')")
     *
     * @Route("/auteur/moderate", name="moderate")
     */
    public function moderateCommentAction()
    {
        return $this->render('Moderation_commentaires/moderateComment.html.twig');
    }
}