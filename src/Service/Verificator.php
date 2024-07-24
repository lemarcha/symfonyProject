<?php

namespace App\Service;

class Verificator
{
    public function verifImput(string $Text)
    {
        $textBase = ["puissance"];
        if (in_array($Text, $textBase)) {
            return True;
        } else {
            return false;
        }
    }
}