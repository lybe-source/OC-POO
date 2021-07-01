<?php

// Le problème
// Admettons que vous venez de créer une application relativement importante. Vous avez construit cette application en associant plus ou moins la plupart de vos classes entre elles. À présent, vous voudriez modifier un petit morceau de code afin d'ajouter une fonctionnalité à l'application. Problème : étant donné que la plupart de vos classes sont plus ou moins liées, il va falloir modifier un tas de chose ! Le pattern Factory pourra sûrement vous aider.

// Ce motif est très simple à construire. En fait, si vous implémentez ce pattern, vous n'aurez plus de new à placer dans la partie globale du script afin d'instancier une classe. En effet, ce ne sera pas à vous de le faire mais à une classe usine. Cette classe aura pour rôle de charger les classes que vous lui passez en argument. Ainsi, quand vous modifierez votre code, vous n'aurez qu'à modifier le masque d'usine pour que la plupart des modifications prennent effet. En gros, vous ne vous soucierez plus de l'instanciation de vos classes, ce sera à l'usine de le faire !


class PatternFactory {

    public static function load($sgbdr) {
        $class = 'SGBDR_' . $sgbdr;

        if (file_exists($path = $class . '.class.php')) {
            require $path;
            return new $class;
        } else {
            throw new RuntimeException('La classe <strong>'. $class . "</strong> n'a pu être trouvée !");
        }
    } 

}


// Dans votre script, vous pourrez donc faire cela :

try {
    $mysql = PatternFactory::load('MySQL');
} catch (RuntimeException $e) {
    echo $e->getMessage();
}




// Exemple concret

// Le but est de créer une classe qui nous distribuera les objets PDO plus facilement. Nous allons partir du principe que vous avez plusieurs SGBDR, ou plusieurs BDD qui utilisent des identifiants différents. Pour résumer, nous allons tout centraliser dans une classe.

class PDOFactory {

    public static function getMysqlConnexion() {
        $db = new PDO('mysql:host=localhost;dbname=tests', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    }

    public static function getPgsqlConnexion() {
        $db = new PDO('pgsql:host=localhost;dbname=tests', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    }

}