<?php

require('LoadClass.php');
spl_autoload_register('LoadClass'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

$perso = new Personnage(Personnage::FORCE_MOYENNE);

$perso1 = new Personnage(60, 0); // 60 de force, 0 dégat, valeurs passé au __construct de la class Personnage.
$perso2 = new Personnage(100, 10); // 100 de force, 10 dégats, valeurs passé au __construct de la class Personnage.

$perso1->setForce(10);
$perso2->setForce(90);

$perso1->setExperience(2);
$perso2->setExperience(58);

$perso1->frapper($perso2);
$perso1->gagnerExperience();

$perso2->frapper($perso1);
$perso2->gagnerExperience();

$force1 = $perso1->force();
$force2 = $perso2->force();

$xp1 = $perso1->experience();
$xp2 = $perso2->experience();

$degat1 = $perso1->degats();
$degat2 = $perso2->degats();


echo 'Le personnage 1 a ', $perso1->force(), ' de force, contrairement au personnage 2 qui a ', $perso2->force(), ' de force.<br />';
echo 'Le personnage 1 a ', $perso1->experience(), ' de point d\'expérience contrairement au personnage 2 qui en a ', $perso2->experience(), '.<br />';
echo 'Le personnage 1 a ', $perso1->degats(), ' de dégats, contrairement au personnage 2 qui a ', $perso2->degats(), ' de dégats.<br />';
