<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\ArticlesModel;
use AppBundle\Form\Type\ArticlesType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CreateArticleController extends Controller
{
    /**
     * @Security("has_role('ROLE_AUTHOR')")
     *
     * @Route("/author/add", name="add")
     */
    public function addAction(Request $request)
    {
        $articleModel = new ArticlesModel();
        $articleForm = $this->get('form.factory')->create(ArticlesType::class, $articleModel);
        if ($request->isMethod('POST') && $articleForm->handleRequest($request)->isValid()) {
            if ($request->get('submitAction') == 'Publier') {
                $this->get('article_manager')->executeActionOnArticle($this->get('article_manager')->createArticle($articleModel));
                $this->addFlash('success', 'Votre article a bien été publié');
                return $this->redirectToRoute('author_home_page');
            } elseif ($request->get('submitAction') == 'Enregistrer') {
                $this->get('article_manager')->executeActionOnArticle($this->get('article_manager')->recordArticle($articleModel));
                $this->addFlash('success', 'Votre article a bien été enregistré');
                return $this->redirectToRoute('author_home_page');
            }
        }
        return $this->render('Create_Article/add.html.twig', [
            'formView' => $articleForm->createView()]);
    }
}
