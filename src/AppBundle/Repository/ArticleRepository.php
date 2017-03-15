<?php

namespace AppBundle\Repository;



class ArticleRepository extends \Doctrine\ORM\EntityRepository
{
    public function getArticlesList()
    {
        return $this->_em->getRepository('AppBundle:Article')
            ->findBy(
            array(),
            array('id' => 'DESC')
        );
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
