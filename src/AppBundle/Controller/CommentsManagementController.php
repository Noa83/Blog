<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Article;
use AppBundle\Entity\Comment;
use AppBundle\Model\CommentModel;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\Type\CommentType;



class CommentsManagementController extends Controller
{
    /**
     * @Route("/comments/add/{id}/{comment_id}", name="add_comment", requirements={"id" = "\d+"}, defaults={"comment_id" = null})
     * @ParamConverter("comment", class="AppBundle:Comment", options={"id" = "comment_id"})
     */
    public function addCommentAction(Request $request, Article $article, Comment $comment)
    {
        $commentModel = new CommentModel();
        $commentForm = $this->get('form.factory')->create(CommentType::class, $commentModel);
        $commentForm->handleRequest($request);

        $this->get('article_manager')->executeActionOnArticle($this->get('comments_manager')
            ->addComment($commentModel, $article, $comment));

        $this->addFlash('success', 'Ce commentaire a été ajouté');
        return $this->redirectToRoute('visualization_article', ['id' => $article->getId()]);
    }

    /**
     * @Route("/comments/signal/{id}", name="signal", requirements={"id" = "\d*"})
     */
    public function signalAction(Comment $comment)
    {
        $this->get('comments_manager')->executeActionOnComment($this->get('comments_manager')->signalComment($comment));
        $this->addFlash('success', 'Ce commentaire a été signalé à l\'auteur');

        return $this->redirectToRoute('visualization_article', ['id' => $comment->getArticle()->getId()]);
    }
}
