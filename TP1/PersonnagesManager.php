<?php

class PersonnagesManager {

    private $_db;

    public function __construct($db) {
        $this->setDb($db);
    }

    public function add(Personnage $perso) {
        $q = $this->_db->prepare('INSERT INTO tp1_jeucombat(nom) VALUES(:nom)');
        $q->bindValue(':nom', $perso->nom());
        $q->execute();
    }

    public function count() {
        return $this->_db->query('SELECT COUNT(*) FROM tp1_jeucombat')->fetchColumn();
    }

    public function delete(Personnage $perso) {
        $this->_db->exec('DELETE FROM tp1_jeucombat WHERE id = '. $perso->id());
    }

    public function exists($info) {
        if (is_int($info)) {
            return (bool) $this->_db->query('SELECT COUNT(*) FROM tp1_jeucombat WHERE id ='. $info)->fetchColumn();
        }

        $q = $this->_db->prepare('SELECT COUNT(*) FROM tp1_jeucombat WHERE nom = :nom');
        $q->execute([':nom' => $info]);

        return (bool) $q->fetchColumn();
    }

    public function get($info) {
        if (is_int($info)) {
            $q = $this->_db->query('SELECT id, nom, degats FROM tp1_jeucombat WHERE id = '. $info);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);

            return new Personnage($donnees);
        } else {
            $q = $this->_db->prepare('SELECT id, nom, degats FROM tp1_jeucombat WHERE nom = :nom');
            $q->execute([':nom' => $info]);

            return new Personnage($q->fetch(PDO::FETCH_ASSOC));
        }
    }

    public function getList($nom) {
        $perso = [];

        $q = $this->_db->prepare('SELECT id, nom, degats FROM tp1_jeucombat WHERE nom <> :nom ORDER BY nom');
        $q->execute([':nom' => $nom]);

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $perso[] = new Personnage($donnees);
        }

        return $perso;
    }

    public function update(Personnage $perso) {
        $q = $this->_db->prepare('UPDATE tp1_jeucombat SET degats = :degats WHERE id = :id');

        $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
        $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);

        $q->execute();
    }

    public function setDb(PDO $db) {
        $this->_db = $db;
    }

}