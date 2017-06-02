<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DraftCopyController extends Controller
{
    /**
     * @Security("has_role('ROLE_AUTHOR')")
     *
     * @Route("/author/drafts", name="drafts")
     */
    public function draftsAction()
    {
        $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');
        $unpublishedArticlesList =  $articleRepository->getUnpublishedArticlesList();

        return $this->render('Draft_copy/draft.html.twig', [
            'unpublishedArticlesList' => $unpublishedArticlesList
        ]);
    }
}