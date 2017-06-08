<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Comment;
use AppBundle\Model\CommentModel;
use AppBundle\Form\Type\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class ArticleVisualizationController extends Controller
{

    /**
     * @Route("/article/{id}", name="visualization_article", requirements={"id" = "\d+"})
     */
    public function articleAction(Article $article, Request $request)
    {
        $articlesList =  $this->getDoctrine()->getRepository('AppBundle:Article')->getArticlesList();
        $comments = $this->getDoctrine()->getRepository('AppBundle:Comment')->findBy(['article'=>$article]);
        dump($article->getComments());
        dump($comments);
        $commentModel = new CommentModel();
        $commentForm = $this->get('form.factory')->create(CommentType::class, $commentModel);

        if ($request->isMethod('POST') && $commentForm->handleRequest($request)->isValid()) {

            $this->get('article_management_in_bdd')->executeActionOnArticle($this->get('comments_management')->addComment($commentModel, $article));
            $this->addFlash('success', 'Ce commentaire a été signalé à l\'auteur');

            return $this->redirectToRoute('visualization_article', ['id' => $article->getId()]);
        }

        return $this->render('Article_reading/article.html.twig', [
            'article' => $article,
            'comments' => $comments,
            'articlesList' => $articlesList,
            'formView' => $commentForm->createView()
        ] );
    }

    /**
     * @Route("/comments/signal/{id}", name="signal", requirements={"id" = "\d+"})
     */
    public function signalAction(Comment $comment)
    {
        $this->get('comments_management')->executeActionOnComment($this->get('comments_management')->signalComment($comment));
        $this->addFlash('success', 'Ce commentaire a été signalé à l\'auteur');

        return $this->redirectToRoute('visualization_article', ['id' => $comment->getArticle()->getId()]);
    }


    /**
     * @Route("/example", name="example")
     */
    public function addCommentForExample()
    {
        $article = $this->getDoctrine()->getRepository('AppBundle:Article')->find(1);
        $comment1 = new Comment();
        $comment1->setArticle($article);
        $comment1->setAuthor('auteur1');
        $comment1->setContent('content1');

        $comment2 = new Comment();
        $comment2->setArticle($article);
        $comment2->setAuthor('auteur2');
        $comment2->setContent('content2');
        $comment2->setParent($comment1);

        $article->addComment($comment1);
        $article->addComment($comment2);
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
    }
}
