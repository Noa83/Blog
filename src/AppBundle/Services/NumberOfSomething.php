<?php

namespace AppBundle\Services;


class NumberOfSomething{
    public function getNumberOfSomething($somethingList)
    {
        $numberOfThings = 0;
        foreach ($somethingList as $thing){
            $count = count($thing);
            $numberOfThings += $count;
        }
        return $numberOfThings;
    }

}
