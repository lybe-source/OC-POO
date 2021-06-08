<?php

class PersonnagesManager {

    private $_db;

    public function __construct($db) {
        $this->setDb($db);
    }

    public function add(Personnage $perso) {
        // Préparation de la requète d'insertion.
        // Assignation des valeurs pour le nom, la force, les dégats, l'expérience et le niveau du personnage.
        // Exécution de la requète.
    }

    public function delete(Personnage $perso) {
        // Exécute une requète de type DELETE.
    }

    public function get($id) {
        // Exécute une requète de type SELECT avec une clause WHERE, et retourne un objet Personnage.
    }

    public function getList() {
        // Retourne la liste de tous les personnages.
    }

    public function update(Personnage $perso) {
        // Prépare une requète de type UPDATE.
        // Assignation des valeurs à la requète.
        // Exécution de la requète.
    }

    public function setDb(PDO $db) {
        $this->_db = $db;
    }
    
}