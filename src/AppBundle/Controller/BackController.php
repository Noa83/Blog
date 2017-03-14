<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\ArticlesModel;
use AppBundle\Form\Type\ArticlesType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\ArticleRepository;

class BackController extends Controller
{
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

    public function removeAction()
    {
        return $this->render('Back/remove.html.twig');
    }

    public function updateAction()
    {
        $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');
        $articlesList =  $articleRepository->getArticlesList();
        dump($articlesList);

        return $this->render('Back/update.html.twig', [
            'articlesList' => $articlesList
        ]);
    }

    public function moderateCommentAction()
    {
        return $this->render('Back/moderateComment.html.twig');
    }
}