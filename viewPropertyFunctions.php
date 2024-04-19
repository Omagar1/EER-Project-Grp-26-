<?php

function ratingTocolour($eerInput){
         
    $ratingColour = "";

    switch($eerInput){
        case "A":
            $ratingColour = "view-0ab654-container";
            return $ratingColour;
        case "B":
            $ratingColour = "view-f0ee07-container";
            return $ratingColour;
        case "C":
            $ratingColour = "view-f7911a-container";
            return $ratingColour;
        case "D":
            $ratingColour = "view-ca7b1e-container";
            return $ratingColour;
        case "E":
            $ratingColour = "view-ca4d1e-container";
            return $ratingColour;
        case "F":
            $ratingColour = "view-ca1e1e-container";
            return $ratingColour;
        case "G":
            $ratingColour = "view-c60909-container";
            return $ratingColour;
        default:
            $ratingColour = "display-container";
            return $ratingColour;
        }
    
}

?>