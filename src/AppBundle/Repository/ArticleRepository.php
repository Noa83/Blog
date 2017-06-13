<?php

namespace AppBundle\Repository;



class ArticleRepository extends \Doctrine\ORM\EntityRepository
{
    public function getArticlesList()
    {
        return $this->createQueryBuilder('a')
            ->where('a.published = true')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function getUnpublishedArticlesList()
    {
        return $this->createQueryBuilder('a')
            ->where('a.published = false')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findRootComments($articleId)
    {
        $results = $this->createQueryBuilder('a')
            ->addSelect('c')
//            ->addSelect('children')
            ->join('a.comments', 'c')
//            ->join('c.children', 'children')
            ->where('c.parent IS NULL')
            ->andWhere('a.id = :id')
            ->setParameter('id', $articleId)
            ->getQuery()
            ->getSingleResult();

        if (empty($results)) {
            throw new \Exception();
        }
        return $results;
    }
}
