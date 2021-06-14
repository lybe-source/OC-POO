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


$obj = new MethodeMagique('');

$obj->attribut = 'Simple test<br />';
$obj->unAttributPrive = 'Autre simple test<br />';

$obj->afficherAttributs();

echo $obj->attribut;
echo $obj->unAutreAttribut;

if (isset($obj->attribut)) {
  echo 'L\'attribut <strong>attribut</stron> existe !<br />';
} else {
  echo 'L\'attribut <strong>attribut</strong> n\'existe pas !<br />';
}

unset($obj->attribut);

if (isset($obj->attribut)) {
  echo 'L\'attribut <strong>attribut</stron> existe !<br />';
} else {
  echo 'L\'attribut <strong>attribut</strong> n\'existe pas !<br />';
}

if (isset($obj->unAutreAttribut)) {
  echo 'L\'attribut <strong>unAutreAttribut</strong> existe !<br />';
} else {
  echo 'L\'attribut <strong>unAutreAttribut</strong> n\'existe pas !<br />';
}

$obj->methode(123, 'test');


MethodeMagique::methodeStatique(456, 'autre test');

$obj2 = new MethodeMagique('Hello world !');

// Solution 1 : le cast

$text = (string) $obj2;
var_dump($text); // Affiche : string(13) "Hello world !"

// Solution 2 : directement dans un echo
echo $obj2 . '<br />'; // Affiche : Hello world !


$obj3 = new MethodeMagique('', 'Hello', 'world !');

eval('$obj4 = ' . var_export($obj3, true) . ';'); // On crée un autre objet, celui-ci ayant les mêmes attributs que l'objet précédent.

echo '<pre>', print_r($obj4, true), '</pre>';


$obj5 = new MethodeMagique();
$obj5('Petit test'); // Utilisation de l'objet comme fonction.