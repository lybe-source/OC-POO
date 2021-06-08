<?php

class Personnage {

    private $_id;
    private $_nom;
    private $_forcePerso;
    private $_degats;
    private $_niveau;
    private $_experience;

    // Déclaration des constantes en rapport avec la force.
    const FORCE_PETITE = 20;
    const FORCE_MOYENNE = 50;
    const FORCE_GRANDE = 80;

    // Variable statique PRIVÉE.
    private static $_textADire = "Je suis un personnage<br />";

    public function __construct($forceInitial, $degats = null) // Constructeur demandant 2 paramètres
    {
        echo "Voici le constructeur !<br />"; // Message s'affichant une fois que tout objet est créé.
        //$this->setForce($forceInitial); // Initialisation de la force.
        //$this->setDegats($degats); // Initialisation des dégats.
        $this->_experience = 1; // Intialisation de l'expérience à 1.
    }

    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut
            $method = 'set' . ucfirst($key);

            // On vérifie si le setter correspondant existe
            if (method_exists($this, $method)) {
                // On appel le setter
                $this->$method($value);
            }
        }
    }


    public function frapper(Personnage $persoAFrapper) {
        $persoAFrapper->_degats += $this->_forcePerso;
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
    // Mutateur chargé de modifier l'attribut $_id
    public function setId($id) {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int) $id;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->_id = $id;
        }
    }

    // Mutateur chargé de modifier l'attribut $_nom
    public function setNom($nom) {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($nom)) {
            $this->_nom = $nom;
        }
    }
    // Mutateur chargé de modifier l'attribut $_forcePerso
    public function setForcePerso($forcePerso) {
        $forcePerso = (int) $forcePerso;

        if ($forcePerso >= 1 && $forcePerso <= 100) {
            $this->_forcePerso = $forcePerso;
        }

    }

    // Mutateur chargé de modifier l'attribut $_degats
    public function setDegats($degats) {
        $degats = (int) $degats;

        if ($degats >= 0 && $degats <= 100) {
            $this->_degats = $degats;
        }
    }

    // Mutateur chargé de modifier l'attribut $_niveau
    public function setNiveau($niveau) {
        $niveau = (int) $niveau;

        if ($niveau >= 1 && $niveau <= 100) {
            $this->_niveau = $niveau;
        }
    }

    // Mutateur chargé de modifier l'attribut $_experience
    public function setExperience($experience) {
        $experience = (int) $experience;

        if ($experience >= 1 && $experience <= 100) {
            $this->_experience = $experience;
        }
    }


    // Getter de la classe Personnage

    // Ceci est la méthode id() : elle se charge de renvoyer le contenu de l'attribut $_id
    public function id() {
        return $this->_id;
    }

    // Ceci est la méthode nom() : elle se charge de renvoyer le contenu de l'attribut $_nom
    public function nom() {
        return $this->_nom;
    }

    // Ceci est la méthode force() : elle se charge de renvoyer le contenu de l'attribut $_forcePerso
    public function forcePerso() {
        return $this->_forcePerso;
    }

    // Ceci est la méthode dégats() : elle se charge de renvoyer le contenu de l'attribut $_degats
    public function degats() {
        return $this->_degats;
    }

    // Ceci est la méthode niveau() : elle se charge de renvoyer le contenu de l'attribut $_niveau
    public function niveau() {
        return $this->_niveau;
    }

    // Ceci est la méthode experience() : elle se charge de renvoyer le contenu de l'attribut $_experience
    public function experience() {
        return $this->_experience;
    }

}
