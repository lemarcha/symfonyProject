<?php

namespace App\Helper;

use phpDocumentor\Reflection\Types\Boolean;

class VerificatorWordFour{
    public function verifWordFour($word, $wordDb): bool{
        $equal = false;

        if(strcasecmp($word, $wordDb) == 0){
            $equal = true;
        }

        return $equal;
    }
}