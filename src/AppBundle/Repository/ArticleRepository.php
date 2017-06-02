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

    public function  getArticleById($id)
    {
        return $this->_em->getRepository('AppBundle:Article')
            ->findBy(
                array(),
                array('id' => $id)
            );
    }
}
