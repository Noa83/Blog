<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\ArticlesModel;
use AppBundle\Form\Type\ArticlesType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class BackController extends Controller
{
    /**
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function indexBackAction()
    {
        $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');
        $articlesList =  $articleRepository->getArticlesList();
        dump($articlesList);

        return $this->render('Back/index_back.html.twig', [
            'articlesList' => $articlesList
        ]);
    }

    /**
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function addAction(Request $request)
    {
        $articleModel = new ArticlesModel();
        $articleForm = $this->get('form.factory')->create(ArticlesType::class, $articleModel);
        if ($request->isMethod('POST') && $articleForm->handleRequest($request)->isValid()) {
            $this->get('bdd_recording')->recording($articleModel);
            $this->addFlash('success', 'Votre article a bien été ajouté');

            return $this->redirectToRoute('add');
        }
        return $this->render('Back/add.html.twig', [
            'formView' => $articleForm->createView(),]);
    }

    /**
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function updateAction(Article $article, Request $request)
    {
        $articleModel = new ArticlesModel();
        $articleForm = $this->get('form.factory')->create(ArticlesType::class, $articleModel);
//        $id = $request->get('id');
//        $article = $em->getRepository('OCPlatformBundle:Advert')->find($id);
        dump($article);
        if ($request->isMethod('POST') && $articleForm->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $article->setTitle($articleModel->getTitle());
            $article->setContent($articleModel->getContent());
            $article->setUpdatedDate(new \DateTime());
            $em->persist($article);
            $em->flush();
            $this->addFlash('success', 'Votre article a bien été ajouté');

            return $this->redirectToRoute('index_back');
        }

//        $em = $this->getDoctrine()->getManager();
//        $article->setTitle();
//        $article->setContent();
//        $article->setUpdatedDate(new \DateTime());
//        $em->refresh($article);
//        $em->flush();
////        $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');
////        $articleId =  $articleRepository->getArticleById($id);
//        dump($article);

        return $this->render('Back/update.html.twig', [
            'formView' => $articleForm->createView(),
            'article' => $article
        ]);
    }

    /**
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function deleteAction(Article $article)
    {
//        $id = $request->get('id');
//        $em = $this->getDoctrine()->getManager();
//        $article = $em->getRepository('OCPlatformBundle:Advert')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('index_back');
    }

    /**
     * @Security("has_role('ROLE_AUTHOR')")
     */
    public function moderateCommentAction()
    {
        return $this->render('Back/moderateComment.html.twig');
    }
}