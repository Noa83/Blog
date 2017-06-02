<?php

namespace AppBundle\Services;

use AppBundle\Model\ArticlesModel;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Article;

class GestionArticleDansBdd
{
    private $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function createArticle(ArticlesModel $articleModel)
    {
        $article = new Article();
        $article->setTitle($articleModel->getTitle());
        $article->setContent($articleModel->getContent());
        $article->setPublished(true);
        return $article;
    }

    public function recordArticle(ArticlesModel $articleModel)
    {
        $article = new Article();
        $article->setTitle($articleModel->getTitle());
        $article->setContent($articleModel->getContent());
        $article->setPublished(false);
        return $article;
    }

    public function updateArticle(ArticlesModel $articleModel, Article $article)
    {
        $article->setTitle($articleModel->getTitle());
        $article->setContent($articleModel->getContent());
        $article->setUpdatedDate(new \DateTime());
        return $article;
    }

    public function deleteArticle(Article $article)
    {
        $em = $this->manager;
        $em->remove($article);
        $em->flush();
    }

    public function unpublishArticle(Article $article)
    {
        $article->setPublished(false);
        return $article;
    }

    public function publishArticle(Article $article)
    {
        $article->setPublished(true);
        return $article;
    }

    public function executeActionOnArticle(Article $article)
    {
        $em = $this->manager;
        $em->persist($article);
        $em->flush();
    }
}
