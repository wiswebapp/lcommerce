<?php

namespace App\macro;

class GeneralMacros{

    public function searchSystem()
    {
        return function($searchTerm){
           echo $searchTerm;
        };
    }

}