<?php

namespace App\Mot3Service;


class Validator
{

    public function checkWorld(String $name)
    {

        $motAdeviner = "photocopie";

        if ($name === $motAdeviner) {
            return true;
        } else {
            return false;
        }
    }
}
