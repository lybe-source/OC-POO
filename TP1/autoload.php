<?php

function chargerClasse($classname) {
    require $classname . '.php';
}

spl_autoload_register('chargerClasse');

$db = new PDO('mysql:host=localhost;dbname=poo_section1', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requète a échoué

$manager = new PersonnagesManager($db);

if (isset($_POST['creer']) && isset($_POST['nom'])) {
    $perso = new Personnage(['nom' => $_POST['nom']]);

    if (!$perso->nomValide()) {
        $message = 'Le nom choisi est invalide.';
        unset($perso);
    } elseif ($manager->exists($perso->nom())) {
        $message = 'Le nom du personnage est déjà pris.';
        unset($perso);
    } else {
        $manager->add($perso);
    }
} elseif (isset($_POST['utiliser']) && isset($_POST['nom'])) {
    if ($manager->exists($_POST['nom'])) {
        $perso = $manager->get($_POST['nom']);
    } else {
        $message = 'Ce personnage n\'existe pas !';
    }
}