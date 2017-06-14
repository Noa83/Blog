<?php

namespace AppBundle\Controller;


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
     */
    public function validateAction(Comment $comment)
    {
        $this->get('comments_management')->executeActionOnComment($this->get('comments_management')->validateComment($comment));
        $this->addFlash('success', 'Ce commentaire a été validé');

        return $this->redirectToRoute('moderate');
    }

    /**
     * @Route("/comments/delete_com/{id}", name="delete_comment", requirements={"id" = "\d+"})
     */
    public function deleteCommentAction(Comment $comment)
    {
        $this->get('comments_management')->deleteComment($comment);
        $this->addFlash('success', 'Ce commentaire a été supprimé');

        return $this->redirectToRoute('moderate');
    }
}