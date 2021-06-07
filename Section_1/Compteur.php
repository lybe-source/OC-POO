<?php

class Compteur {

    // Déclaration de la variable $_compteur
    private static $_compteur = 0;

    public function __construct()
    {
        // On instancie la variable $_compteur qui appartient à la classe (donc utilisation du mot-clé self)
        self::$_compteur++;        
    }

    public static function getCompteur() {
        return self::$_compteur;
    }

}
