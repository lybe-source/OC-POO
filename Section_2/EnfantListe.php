<?php

class EnfantListe extends Liste {

    // Redéclaration de la fonction pour que ce ne soit pas celle de la classe mère qui soit appelée
    function listeAttributs() {
        foreach ($this as $attribut => $valeur) {
            echo '<strong>', $attribut, '</strong> => ', $valeur, '<br />';
        }
    }
}