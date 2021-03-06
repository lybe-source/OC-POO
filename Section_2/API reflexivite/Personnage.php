<?php

abstract class Personnage {

    protected $atout;
    protected $degats;
    protected $id;
    protected $nom;
    protected $timeEndormi;
    protected $type;

    const CEST_MOI = 1;
    const PERSONNAGE_TUE = 2;
    const PERSONNAGE_FRAPPE = 3;
    const PERSONNAGE_ENSORCELE = 4;
    const PAS_DE_MAGIE = 5;
    const PERSO_ENDORMI = 6;

    public function __construct(array $donnees) {
        $this->hydrate($donnees); // Appel de la fonction hydrate avec le tableau de données, lesquelles sont les attributs du personnage
        $this->type = strtolower(static::class); // On donne à l'attribut type la valeur en minuscule qui est le nom de la classe appelé à la création du personnage
    }

    public function estEndormi() {
        return $this->timeEndormi > time();
    }

    public function frapper(Personnage $perso) {
        if ($perso->id == $this->id) {
            return self::CEST_MOI;
        }

        if ($this->estEndormi()) {
            return self::PERSO_ENDORMI;
        }

        // On indique au personnage qu'il doit recevoir des dégats.
        // Puis on retourne la valeur renvoyée par la méthode : self::PERSONNAGE_TUE ou self::PERSONNAGE_FRAPPE
        return $perso->recevoirDegats();
    }

    // Méthode permettant d'hydrater les attributs de la classe
    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key); // $method = setId($id), etc

            if (method_exists($this, $method)) { // Si la méthode existe dans la classe
                $this->$method($value);
            }
        }
    }

    public function nomValide() {
        return !empty($this->nom);
    }

    public function recevoirDegats() {
        $this->degats += 5;

        // Si on a 100 de dégats ou plus, on supprime le personnage de la BDD
        if ($this->degats >= 100) {
            return self::PERSONNAGE_TUE;
        }

        // Sinon, on se contente de mettre à jour les dégats du personnage
        return self::PERSONNAGE_FRAPPE;
    }

    public function reveil() {
        $secondes = $this->timeEndormi;
        $secondes -= time();
        
        $heures = floor($secondes / 3600);
        $secondes -= $heures * 3600;

        $minutes = floor($secondes / 60);
        $secondes -= $minutes * 60;

        $heures .= $heures <= 1 ? ' heure' : ' heures';
        $minutes .= $minutes <= 1 ? ' minute' : ' minutes';
        $secondes .= $secondes <= 1 ? ' seconde' : ' secondes';

        return $heures . ', ' . $minutes . ' et ' . $secondes;
    }

    // Getters
    public function atout() {
        return $this->atout;
    }

    public function degats() {
        return $this->degats;
    }

    public function id() {
        return $this->id;
    }

    public function nom() {
        return $this->nom;
    }

    public function timeEndormi() {
        return $this->timeEndormi;
    }

    public function type() {
        return $this->type;
    }


    // Setters
    public function setAtout($atout) {
        $atout = (int) $atout;

        if ($atout >= 0 && $atout <= 100) {
            $this->atout = $atout;
        }
    }

    public function setDegats($degats) {
        $degats = (int) $degats;

        if ($degats >= 0 && $degats <= 100) {
            $this->degats = $degats;
        }
    }

    public function setId($id) {
        $id = (int) $id;

        if ($id > 0) {
            $this->id = $id;
        }
    }

    public function setNom($nom) {
        if (is_string($nom)) { // Si $nom est une chaine de caractère
            $this->nom = $nom;
        }
    }

    public function setTimeEndormi($time) {
        $this->timeEndormi = (int) $time;
    }
    
}