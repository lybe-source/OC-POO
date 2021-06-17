<?php

class Liste {
    
    public $attribut1 = 'Premier attribut public';
    public $attribut2 = 'Deuxième attribut public';

    protected $attributProtege1 = 'Premier attribut protégé';
    protected $attributProtege2 = 'Deuxième attribut protégé';

    private $attributPrive1 = 'Premier attribut privé';
    private $attributPrive2 = 'Deuxième attribut privé';

    function listeAttributs() {
        foreach($this as $attribut => $valeur) {
            echo '<strong>', $attribut, '</strong> => ', $valeur, '<br />';
        }
    }
}