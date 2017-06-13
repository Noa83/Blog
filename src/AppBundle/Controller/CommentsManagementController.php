<?php

namespace AppBundle\Controller;



use AppBundle\Entity\Comment;
use AppBundle\Model\CommentModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\Type\CommentType;

class CommentsManagementController extends Controller
{
    /**
     * @Route("/comments/add/{id}", name="add_comment", requirements={"id" = "\d+"})
     */
    public function addCommentWithAjax(Request $request)
    {

        $commentModel = new CommentModel();
        $commentForm = $this->get('form.factory')->create(CommentType::class, $commentModel);
        $commentForm->handleRequest($request);
        dump($commentModel);
        dump($commentForm);

           dump($commentModel->setContent($commentForm->getData()));


//        $this->get('article_management_in_bdd')->executeActionOnArticle($this->get('comments_management')->addComment($commentModel, $article));
//        $this->addFlash('success', 'Ce commentaire a été signalé à l\'auteur');
//
//        return $this->redirectToRoute('visualization_article', ['id' => $article->getId()]);
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