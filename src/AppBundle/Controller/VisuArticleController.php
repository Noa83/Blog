<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Commentaire;
use AppBundle\Model\CommentModel;
use AppBundle\Form\Type\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class VisuArticleController extends Controller
{

    /**
     * @Route("/article/{id}", name="visu_article", requirements={"id" = "\d+"})
     */
    public function articleAction(Article $article, Request $request)
    {
        $articlesList =  $this->getDoctrine()->getRepository('AppBundle:Article')->getArticlesList();

//        dump($articlesList);

        $commentModel = new CommentModel();
        $commentForm = $this->get('form.factory')->create(CommentType::class, $commentModel);

        if ($request->isMethod('POST') && $commentForm->handleRequest($request)->isValid()) {
            //à remplir.
            dump($request);
            $commentaire = new Commentaire();
            $commentaire->setAuteur($commentModel);
            $commentaire->setContenu($commentModel);

            $article->addCommentaire($commentaire);
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
        }

        return $this->render('Lecture_Article/article.html.twig', [
            'article' => $article,
            'articlesList' => $articlesList,
            'formView' => $commentForm->createView()
        ] );
    }
}
