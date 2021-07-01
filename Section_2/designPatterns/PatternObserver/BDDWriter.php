<?php

class BDDWriter implements SplObserver {

    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function update(SplSubject $subject)
    {
        $q = $this->db->prepare('INSERT INTO erreurs SET erreur = :erreur');
        $q->bindValue(':erreur', $subject->getFormatedError());
        $q->execute();
    }

}