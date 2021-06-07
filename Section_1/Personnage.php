<?php

class Personnage {

    private $_force = 20;
    private $_localisation;
    private $_experience = 50;
    private $_degats = 0;

    // Déclaration des constantes en rapport avec la force.
    const FORCE_PETITE = 20;
    const FORCE_MOYENNE = 50;
    const FORCE_GRANDE = 80;

    // Variable statique PRIVÉE.
    private static $_textADire = "Je suis un personnage<br />";

    public function __construct($forceInitial, $degats = null) // Constructeur demandant 2 paramètres
    {
        echo "Voici le constructeur !<br />"; // Message s'affichant une fois que tout objet est créé.
        $this->setForce($forceInitial); // Initialisation de la force.
        //$this->setDegats($degats); // Initialisation des dégats.
        $this->_experience = 1; // Intialisation de l'expérience à 1.
    }


    public function frapper(Personnage $persoAFrapper) {
        $persoAFrapper->_degats += $this->_force;
    }

    public function gagnerExperience() {
        // Ceci est un raccourci qui équivaut à écrire " $this->_experience = $this->_experience + 1 "
        // On aurait aussi pu écrire " $this->_experience += 1 "
        $this->_experience++;
    }

    public static function parler() {
        echo self::$_textADire; // On donne le texte à dire
    }

    public function afficherExperience() {
        echo $this->_experience;
    }


    // Setter de la classe Personnage
    // Mutateur chargé de modifier l'attribut $_force
    public function setForce($force) {
        // S'il ne s'agit pas d'un nombre entier.
        if ( in_array( $force, [ self::FORCE_PETITE, self::FORCE_MOYENNE, self::FORCE_GRANDE ] ) )  {
            $this->_force = $force;
        }

    }

    // Mutateur chargé de modifier l'attribut $_degats
    public function setDegats($degats) {
        // S'il ne s'agit pas d'un nombre entier.
        if (!is_int($degats)) {
            trigger_error('Le niveau de dégats d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }

        $this->_degats = $degats;
    }

    // Mutateur chargé de modifier l'attribut $_experience
    public function setExperience($experience) {
        // S'il ne s'agit pas d'un nombre entier
        if (!is_int($experience)) {
            trigger_error('L\'expérience d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }

        // On vérifie bien qu'on ne souhaite pas assigner une valeur supérieur à 100
        if ($experience > 100) {
            trigger_error('L\'expérience d\'un personnage ne peut dépasser 100', E_USER_WARNING);
            return;
        }

        $this->_experience = $experience;
    }


    // Getter de la classe Personnage
    // Ceci est la méthode dégats() : elle se charge de renvoyer le contenu de l'attribut $_degats
    public function degats() {
        return $this->_degats;
    }

    // Ceci est la méthode force() : elle se charge de renvoyer le contenu de l'attribut $_force
    public function force() {
        return $this->_force;
    }

    // Ceci est la méthode experience() : elle se charge de renvoyer le contenu de l'attribut $_experience
    public function experience() {
        return $this->_experience;
    }

}
