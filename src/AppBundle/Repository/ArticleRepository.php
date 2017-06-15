<?php

namespace AppBundle\Repository;



use Doctrine\ORM\Tools\Pagination\Paginator;

class ArticleRepository extends \Doctrine\ORM\EntityRepository
{
    public function getPublishedArticlesList()
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
            ->join('a.comments', 'c')
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

    public function findArticlesForPagination($page, $numberPerPage)
    {
        $query = $this->createQueryBuilder('a')
            ->where('a.published = true')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->setFirstResult(($page - 1)*$numberPerPage)
            ->setMaxResults($numberPerPage);

        return new Paginator($query, true);
    }
}
