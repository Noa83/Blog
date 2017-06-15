<?php

namespace AppBundle\Controller;


use AppBundle\Model\CommentModel;
use AppBundle\Form\Type\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;


class ArticleVisualizationController extends Controller
{

    /**
     * @Route("/article/{id}", name="visualization_article", requirements={"id" = "\d+"})
     */
    public function articleAction(Request $request, Article $article)
    {
        $comments = '';
        $commentsError ='';
        $articlesList =  $this->getDoctrine()->getRepository('AppBundle:Article')->getPublishedArticlesList();
        try{
            $articleWithRootComments = $this->getDoctrine()->getRepository('AppBundle:Article')->findRootComments($article);
            $comments = $articleWithRootComments->getComments();
        }catch(\Exception $e){
            $commentsError = "Aucun commentaire n'a encore été saisi sur ce chapitre";
        }
        $commentModel = new CommentModel();
        $commentForm = $this->get('form.factory')->create(CommentType::class, $commentModel);

        return $this->render('Article_reading/article.html.twig', [
            'article' => $article,
            'comments' => $comments,
            'commentError' => $commentsError,
            'articlesList' => $articlesList,
            'formView' => $commentForm->createView()
        ] );
    }
}
