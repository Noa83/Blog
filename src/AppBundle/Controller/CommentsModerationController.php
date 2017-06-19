<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Comment;

class CommentsModerationController extends Controller
{
    /**
     * @Security("has_role('ROLE_AUTHOR')")
     *
     * @Route("/author/moderate", name="moderate")
     * @Method({"GET", "POST"})
     */
    public function moderateCommentAction()
    {
        $signaledComments = $this->getDoctrine()->getRepository('AppBundle:Comment')->getSignaledComments();

        return $this->render('Comments_moderation/moderateComment.html.twig', [
            'signaledComments' => $signaledComments
        ]);
    }

    /**
     * @Route("/comments/validate/{id}", name="validate", requirements={"id" = "\d+"})
     * @Method({"GET", "POST"})
     */
    public function validateAction(Comment $comment)
    {
        $this->get('comments_manager')->executeActionOnComment($this->get('comments_manager')->validateComment($comment));
        $this->addFlash('success', 'Ce commentaire a été validé');

        return $this->redirectToRoute('moderate');
    }

    /**
     * @Route("/comments/delete_com/{id}", name="delete_comment", requirements={"id" = "\d+"})
     * @Method({"GET", "POST"})
     */
    public function deleteCommentAction(Comment $comment)
    {
        $this->get('comments_manager')->deleteComment($comment);
        $this->addFlash('success', 'Ce commentaire a été supprimé');

        return $this->redirectToRoute('moderate');
    }
}
