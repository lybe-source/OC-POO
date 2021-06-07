<?php

require('LoadClass.php');
spl_autoload_register('LoadClass'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

$perso = new Personnage(Personnage::FORCE_MOYENNE);
$perso::parler(); // Appel de la fonction static parler dans la classe Personnage.

$test1 = new Compteur;
$test2 = new Compteur;
$test3 = new Compteur;

echo Compteur::getCompteur();