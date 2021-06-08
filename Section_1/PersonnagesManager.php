<?php

class PersonnagesManager {

    private $_db;

    public function __construct($db) {
        $this->setDb($db);
    }

    public function add(Personnage $perso) {
        // Préparation de la requète d'insertion.
        $q = $this->_db->prepare('INSERT INTO personnages(nom, forcePerso, degats, niveau, experience) VALUES(:nom, :forcePerso, :degats, :niveau, :experience)');
        // Assignation des valeurs pour le nom, la force, les dégats, l'expérience et le niveau du personnage.
        $q->bindValue(':nom', $perso->nom());
        $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
        $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
        $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
        $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
        // Exécution de la requète.
        $q->execute();
    }

    public function delete(Personnage $perso) {
        // Exécute une requète de type DELETE.
        $this->_db->exec('DELETE FROM personnages WHERE id = '. $perso->id());
    }

    public function get($id) {
        // Exécute une requète de type SELECT avec une clause WHERE, et retourne un objet Personnage.
        $id = (int) $id;

        $q = $this->_db->query('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnages WHERE id = '. $id());
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new Personnage($donnees);
    }

    public function getList() {
        // Retourne la liste de tous les personnages.
        $perso = [];

        $q = $this->_db->query('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnages ORDER BY nom');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $perso[] = new Personnage($donnees);
        }

        return $perso;
    }

    public function update(Personnage $perso) {
        // Prépare une requète de type UPDATE.
        $q = $this->_db->prepare('UPDATE personnages SET forcePerso = :forcePerso, degats = :degats, niveau = :niveau, experience = :experience WHERE id = :id');
        // Assignation des valeurs à la requète.
        $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
        $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
        $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
        $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
        $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
        // Exécution de la requète.
        $q->execute();
    }

    public function setDb(PDO $db) {
        $this->_db = $db;
    }
    
}