<?php

use Personnage as GlobalPersonnage;

class Personnage {

    private $_id;
    private $_nom;
    private $_degats;

    const PERSONNAGE_FRAPPE = "Le personnage a bien été frappé !"; // 3
    const CEST_MOI = "Le personnage ciblé est le personnage qui attaque !"; // 1
    const PERSONNAGE_TUE = "Vous avez tué ce personnage !"; // 2

    public function __construct(array $donnees) {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function frapper(Personnage $perso) {
        // Avant tout : vérifier qu'on ne se frappe pas soi-même
        if ($perso->id() == $this->_id) {
            return self::CEST_MOI;
        }
        // Si c'est le cas, on stoppe totu en renvoyant une valeur signifiant que le personnage ciblé est le personnage qui attaque
        // On indique au personnage frappé qu'il doit recevoir des dégats
        return $perso->recervoirDegats();
    }

    public function recervoirDegats() {
        // On augmente de 5 les dégats
        $this->_degats += 5;
        // Si on a 100 de dégats ou plus, la méthode renverra une valeur signifiant que le personnage a été tué
        if ($this->_degats >= 100) {
            return self::PERSONNAGE_TUE;
        }
        // Sinon, elle renverra une valeur signifiant que le personnage a bien été frappé
        return self::PERSONNAGE_FRAPPE;
    }

    public function nomValide() {
        return !empty($this->_nom);
    }

    // Getters
    public function id() {
        return $this->_id;
    }

    public function nom() {
        return $this->_nom;
    }

    public function degats() {
        return $this->_degats;
    }

    // Setters
    public function setId($id) {
        $id = (int) $id;

        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setNom($nom) {
        if (is_string($nom)) {
            $this->_nom = $nom;
        }
    }

    public function setDegats($degats) {
        $degats = (int) $degats;

        if ($degats >= 0 && $degats <= 100) {
            $this->_degats = $degats;
        }
    }

}