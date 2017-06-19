<?php

namespace AppBundle\Controller;


use AppBundle\Model\CommentModel;
use AppBundle\Form\Type\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Article;


class ArticleVisualizationController extends Controller
{

    /**
     * @Route("/article/{id}", name="visualization_article", requirements={"id" = "\d+"})
     * @Method({"GET", "POST"})
     */
    public function articleAction(Article $article)
    {
        $articleWithRootComments = $this->getDoctrine()->getRepository('AppBundle:Article')->findRootComments($article->getId());
        $commentModel = new CommentModel();
        $commentForm = $this->get('form.factory')->create(CommentType::class, $commentModel);

        return $this->render('Article_reading/article.html.twig', [
            'article' => $articleWithRootComments,
            'formView' => $commentForm->createView()
        ] );
    }
}
