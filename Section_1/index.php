<?php

require('LoadClass.php');
spl_autoload_register('LoadClass'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

//$perso = new Personnage(Personnage::FORCE_MOYENNE);
//$perso::parler(); // Appel de la fonction static parler dans la classe Personnage.

//$test1 = new Compteur;
//$test2 = new Compteur;
//$test3 = new Compteur;

//echo Compteur::getCompteur();

/* $perso = new Personnage([
    'nom' => 'Victor',
    'forcePerso' => 5,
    'degats' => 0,
    'niveau' => 1,
    'experience' => 1 // Ne peut pas être null
  ]); */
  
  $db = new PDO('mysql:host=localhost;dbname=poo_section1', 'root', '');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.

  $manager = new PersonnagesManager($db);
      
  //$manager->add($perso);
