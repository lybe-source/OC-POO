<?php

class Connexion {

    protected $pdo, $server, $user, $password, $database;

    public function __construct($server, $user, $password, $database)
    {
        $this->server = $server;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

        $this->connexionBDD();
    }

    protected function connexionBDD() {
        $this->pdo = new PDO('mysql:host='. $this->server .';dbname='. $this->database, $this->user, $this->password);
    }

    public function __sleep()
    {
        // Ici sont à placer des instructions à exécuter juste avant la linéarisation
        // On retourne ensuite la liste des attributs qu'on veut sauver
        return ['server', 'user', 'password', 'database'];
    }

    public function __wakeup()
    {
        $this->connexionBDD();
    }

}

// Ainsi on pourrait faire ceci:
/**
 * <?php $connexion = new Connexion('localhost', 'root', '', 'tests');
 * $_SESSION['connexion'] = serialize($connexion);
 */