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
        $articleWithComments = $this->getDoctrine()->getRepository('AppBundle:Article')->findById($article);
        dump($article);
        dump($articleWithComments);


        $commentModel = new CommentModel();
        $commentForm = $this->get('form.factory')->create(CommentType::class, $commentModel);

        if ($request->isMethod('POST') && $commentForm->handleRequest($request)->isValid()) {

//            dump($request);
//            dump($commentModel);
            $comment = new Comment();
            $comment->setAuthor($commentModel->getAuthor());
            $comment->setContent($commentModel->getContent());
            $comment->setArticle($article);
//            dump($comment);

            $article->addComment($comment);
//            dump($article);
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
        }

        return $this->render('Article_reading/article.html.twig', [
            'article' => $article,
            'articlesList' => $articlesList,
            'formView' => $commentForm->createView()
        ] );
    }
}
