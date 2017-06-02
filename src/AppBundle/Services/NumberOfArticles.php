<?php

namespace AppBundle\Services;


class NumberOfArticles
{
    public function getNumberOfArticles($articleList)
    {
        $countNbObsTotale = 0;
        foreach ($articleList as $article){
            $compte = count($article);
            $countNbObsTotale += $compte;
        }
        return $countNbObsTotale;
    }

}
