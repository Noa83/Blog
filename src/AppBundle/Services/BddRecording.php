<?php

namespace AppBundle\Services;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Article;

class BddRecording
{
    private $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function recording($articleModel)
    {
        $article = new Article();
        $article->setTitle($articleModel->getTitle());
        $article->setContent($articleModel->getContent());
        //$article->setPublishedDate(new \DateTime());
        $em = $this->manager;
        $em->persist($article);
        $em->flush();
    }

    public function update($articleModel, $article)
    {
        $article->setTitle($articleModel->getTitle());
        $article->setContent($articleModel->getContent());
        $article->setUpdatedDate(new \DateTime());
        $em = $this->manager;
        $em->persist($article);
        $em->flush();
    }
}
