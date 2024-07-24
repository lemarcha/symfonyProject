<?php 

namespace App\Services;

class Check{
    public function checker(string $text) {
        $motATrouver = "vétérinaire";
        if($text === $motATrouver){
            return true;
        }
        return false;
    }
}
?>