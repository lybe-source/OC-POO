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






/**
 * Nous allons maintenant faire un petit exercice.
 * Je veux que vous me fassiez une classe toute bête
 * qui ne sert à rien.
 * Seulement, à la fin du script, je veux pouvoir afficher
 * le nombre de fois où la classe a été instanciée.
 * Pour cela, vous aurez besoin d'un attribut appartenant
 * à la classe (admettons $_compteur)
 * qui est incrémenté dans le constructeur.
 */