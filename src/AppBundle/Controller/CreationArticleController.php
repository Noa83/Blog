<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\ArticlesModel;
use AppBundle\Form\Type\ArticlesType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CreationArticleController extends Controller
{
    /**
     * @Security("has_role('ROLE_AUTHOR')")
     *
     * @Route("/auteur/add", name="add")
     */
    public function addAction(Request $request)
    {
        $articleModel = new ArticlesModel();
        $articleForm = $this->get('form.factory')->create(ArticlesType::class, $articleModel);
        if ($request->isMethod('POST') && $articleForm->handleRequest($request)->isValid()) {
            if ($request->get('submitAction') == 'Publier') {
                $this->get('gestion_article_dans_bdd')->executeActionOnArticle($this->get('gestion_article_dans_bdd')->createArticle($articleModel));
                $this->addFlash('success', 'Votre article a bien été publié');
                return $this->redirectToRoute('auteur_home_page');
            } elseif ($request->get('submitAction') == 'Enregistrer') {
                $this->get('gestion_article_dans_bdd')->executeActionOnArticle($this->get('gestion_article_dans_bdd')->recordArticle($articleModel));
                $this->addFlash('success', 'Votre article a bien été enregistré');
                return $this->redirectToRoute('auteur_home_page');
            }
        }
        return $this->render('Creation_Article/add.html.twig', [
            'formView' => $articleForm->createView()]);
    }
}