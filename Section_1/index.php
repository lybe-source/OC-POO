<?php

class Personnage {

    private $_force = 20;
    private $_localisation;
    private $_experience = 50;
    private $_degats = 0;

    public function __construct($force, $degats) // Constructeur demandant 2 paramètres
    {
        echo "Voici le constructeur !<br />"; // Message s'affichant une fois que tout objet est créé.
        $this->setForce($force); // Initialisation de la force.
        $this->setDegats($degats); // Initialisation des dégats.
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

    public function parler() {
        echo "Je suis un personnage";
    }

    public function afficherExperience() {
        echo $this->_experience;
    }


    // Setter de la classe Personnage
    // Mutateur chargé de modifier l'attribut $_force
    public function setForce($force) {
        // S'il ne s'agit pas d'un nombre entier.
        if (!is_int($force))  {
            trigger_error('La force d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }

        // On vérifie bien qu'on ne souhaite pas assigner une valeur supérieur à 100
        if ($force > 100) {
            trigger_error('La force d\'un personnage ne peut dépasser 100', E_USER_WARNING);
            return;
        }

        $this->_force = $force;
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

$perso1 = new Personnage(60, 0); // 60 de force, 0 dégat
$perso2 = new Personnage(100, 10); // 100 de force, 10 dégats

$perso1->setForce(10);
$perso2->setForce(90);

$perso1->setExperience(2);
$perso2->setExperience(58);

$perso1->frapper($perso2);
$perso1->gagnerExperience();

$perso2->frapper($perso1);
$perso2->gagnerExperience();

$force1 = $perso1->force();
$force2 = $perso2->force();

$xp1 = $perso1->experience();
$xp2 = $perso2->experience();

$degat1 = $perso1->degats();
$degat2 = $perso2->degats();


echo 'Le personnage 1 a ', $perso1->force(), ' de force, contrairement au personnage 2 qui a ', $perso2->force(), ' de force.<br />';
echo 'Le personnage 1 a ', $perso1->experience(), ' de point d\'expérience contrairement au personnage 2 qui en a ', $perso2->experience(), '.<br />';
echo 'Le personnage 1 a ', $perso1->degats(), ' de dégats, contrairement au personnage 2 qui a ', $perso2->degats(), ' de dégats.<br />';
