<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Model\ArticlesModel;
use AppBundle\Form\Type\ArticlesType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class ArticleManagementController extends Controller
{
    /**
     * @Security("has_role('ROLE_AUTHOR')")
     *
     * @Route("/author/update/{id}", name="update", requirements={"id" = "\d+"})
     */
    public function updateAction(Article $article, Request $request)
    {
        $articleModel = new ArticlesModel();
        $articleForm = $this->get('form.factory')->create(ArticlesType::class, $articleModel);

        if ($request->isMethod('POST') && $articleForm->handleRequest($request)->isValid()) {
            $this->get('article_management_in_bdd')->executeActionOnArticle($this->get('article_management_in_bdd')->updateArticle($articleModel, $article));
            $this->addFlash('success', 'Votre article a bien été ajouté');

            return $this->redirectToRoute('author_home_page');
        }

        return $this->render('Article_management/update.html.twig', [
            'formView' => $articleForm->createView(),
            'article' => $article
        ]);
    }

    /**
     * @Security("has_role('ROLE_AUTHOR')")
     *
     * @Route("/author/delete/{id}", name="delete", requirements={"id" = "\d+"})
     */
    public function deleteAction(Article $article)
    {
        $this->get('article_management_in_bdd')->deleteArticle($article);
        $this->addFlash('success', 'Votre article a bien été supprimé');

        return $this->redirectToRoute('author_home_page');
    }

    /**
     * @Security("has_role('ROLE_AUTHOR')")
     *
     * @Route("/author/unpublish/{id}", name="unpublish", requirements={"id" = "\d+"})
     */
    public function unpublishAction(Article $article)
    {
        $this->get('article_management_in_bdd')->executeActionOnArticle($this->get('article_management_in_bdd')->unpublishArticle($article));
        $this->addFlash('success', 'Votre article a bien été retiré des publications');

        return $this->redirectToRoute('author_home_page');
    }

    /**
     * @Security("has_role('ROLE_AUTHOR')")
     *
     * @Route("/author/publish/{id}", name="publish", requirements={"id" = "\d+"})
     */
    public function publishAction(Article $article)
    {
        $this->get('article_management_in_bdd')->executeActionOnArticle($this->get('article_management_in_bdd')->publishArticle($article));
        $this->addFlash('success', 'Votre article a bien été retiré des publications');

        return $this->redirectToRoute('author_home_page');
    }

}
