<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Article;
use AppBundle\Entity\Comment;
use AppBundle\Model\CommentModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\Type\CommentType;

class CommentsManagementController extends Controller
{
    /**
     * @Route("/comments/add/{id}/{comment_id}", name="add_comment", requirements={"id" = "\d+"}, defaults={"comment_id" = null})
     */
    public function addCommentAction(Request $request, Article $article)
    {

        $commentModel = new CommentModel();
        $commentForm = $this->get('form.factory')->create(CommentType::class, $commentModel);
        $commentForm->handleRequest($request);
        $commentId = $request->attributes->get('comment_id');

        if ( $commentId !== null ){
        $this->get('article_management_in_bdd')->executeActionOnArticle($this->get('comments_management')
            ->addComment($commentModel, $article, $this->getDoctrine()->getRepository('AppBundle:Comment')
                ->find($commentId)));
        }else{
            $this->get('article_management_in_bdd')->executeActionOnArticle($this->get('comments_management')
                ->addRootComment($commentModel, $article));
        }

        $this->addFlash('success', 'Ce commentaire a été signalé à l\'auteur');
        return $this->redirectToRoute('visualization_article', ['id' => $article->getId()]);
    }

    /**
     * @Route("/comments/signal/{id}", name="signal", requirements={"id" = "\d*"})
     */
    public function signalAction(Comment $comment)
    {
        $this->get('comments_management')->executeActionOnComment($this->get('comments_management')->signalComment($comment));
        $this->addFlash('success', 'Ce commentaire a été signalé à l\'auteur');

        return $this->redirectToRoute('visualization_article', ['id' => $comment->getArticle()->getId()]);
    }
}
