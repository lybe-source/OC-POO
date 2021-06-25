<?php

// Obtenir des informations concernant la classe Magicien
$classeMagicien = new ReflectionClass('Magicien'); // Le nom de la classe doit être entre apostrophes ou guillemets

// Obtenir des informations sur une classe grâce à un objet
$magicien = new Magicien(['nom' => 'vyk12', 'type' => 'magicien']);
$classeMagicien = new ReflectionObject($magicien);

// Les attributs
if ($classeMagicien->hasProperty('magie')) {
    echo 'La classe Magicien possède un attribut $magie';
} else {
    echo 'La classe Magicien ne possède pas d\'attribut $magie';
}

// Les méthodes
if ($classeMagicien->hasMethod('lancerUnSort')) {
    echo 'La classe Magicien implémente une méthode lancerUnSort()';
} else {
    echo "La classe Magicien n'implémente pas de méthode lancerUnSort()";
}

// Les constantes
if ($classeMagicien->hasConstant('NOUVEAU')) {
    echo 'La classe Magicien possède une constante NOUVEAU';
} else {
    echo 'La classe Magicien ne possède pas de constante NOUVEAU';
}
// La valeur de la constante
if ($classeMagicien->hasConstant('NOUVEAU')) {
    echo 'La classe Magicien possède une constante NOUVEAU (celle-ci vaut '. $classeMagicien->getConstant('NOUVEAU') . ')';
} else {
    'La classe Magicien ne possède pas de constante NOUVEAU';
}
// Liste complète des constantes d'une classe sous forme de tableau
echo '<pre>' . print_r($classeMagicien->getConstants(), true) . '</pre>';

// Les relations entre classes
// L'héritage et la classe parente
$classeGuerrier = new ReflectionClass('Guerrier');

if ($parent = $classeGuerrier->getParentClass()) {
    echo "La classe Guerrier a un parent : il s'agit de la classe " . $parent->getName();
} else {
    echo "La classe Guerrier n'a pas de parent";
}
// Vérification de classe parente, si la classe donnée en paramètre est la parente cela renverra true aussi non cela renverra false
if ($classeMagicien->isSubclassOf('Personnage')) {
    echo 'La classe Magicien a pour parent la classe Personnage';
} else {
    echo "La classe Magicien n'a pas pour parent la classe Personnage";
}
// Savoir si la classe est abstraite ou finale
$classePersonnage = new ReflectionClass('Personnage');

// Est-elle abstraite ?
if ($classePersonnage->isAbstract()) {
    echo 'La classe Personnage est abstraite';
} else {
    echo "La classe Personnage n'est pas abstraite";
}

// Est-elle finale ?
if ($classePersonnage->isFinal()) {
    echo 'La classe Personnage est finale';
} else {
    echo "La classe Personnage n'est pas finale";
}

// Vérification de l'instanciabilité d'une classe
if ($classePersonnage->isInstantiable()) {
    echo 'La classe Personnage est instanciable';
} else {
    echo "La classe Personnage n'est pas instanciable";
}

// Les interfaces
$classeIMagicien = new ReflectionClass('iMagicien');

if ($classeIMagicien->isInterface()) {
    echo 'La classe iMagicien est une interface';
} else {
    echo "La classe iMagicien n'est pas une interface";
}
// Vérification de l'implémentation d'une interface
if ($classeMagicien->implementsInterface('iMagicien')) {
    echo 'La classe Magicien implémente l\'interface iMagicien';
} else {
    echo "La classe Magicien n'implémente pas l'interface iMagicien";
}
// Les interfaces sous forme de tableau
// Première méthode renvoie autant d'instance de la classe ReflectionClass qu'il y a d'interface, chacune représentant une interface
$tableInterfaceMagicien = $classeMagicien->getInterfaces();
// Seconde méthode renvoie un tableau contenant le nom de toutes les interfaces implémentées
$tableInterfaceMagicien = $classeMagicien->getInterfaceNames();


// Obtenir des informations sur les attributs de ses classes
// Instanciation directe
$attributMagie = new ReflectionProperty('Magien', 'magie');

// Récupérer un attribut
$attributClasseMagicien = new ReflectionClass('Magicien');
$attributMagie = $attributClasseMagicien->getProperty('magie');

// Récupérer tous les attributs
$classePersonnage = new ReflectionClass('Personnage');
$attributsPersonnage = $classePersonnage->getProperties();

// Lister tout les attributs d'une classe
$attributsClasseMagicien = new ReflectionClass('Magicien');
$magicien = new Magicien(['nom' => 'byk12', 'type' => 'magicien']);

foreach ($attributsClasseMagicien->getProperties() as $attribut) {
    $attribut->setAccessible(true); // Il faut rendre l'attribut accessible s'il n'est pas en public
    echo $attribut->getName() . ' => ' . $attribut->getValue($magicien);
    $attribut->setAccessible(false); // Pour garder le principe d'encapsulation, et empêcher que l'on modifie la valeur de l'attribut grâce à la méthode ReflectionProperty::setValue($object, $value) il faut le rendre inaccessible après avoir sa lecture
}

// Connaître la portée de l'attribut : private, protected or public
$uneClasse = new ReflectionClass('MaClasse');

foreach ($uneClasse->getProperties() as $attribut) {
    echo $attribut->getName() . ' => attribut ';

    if ($attribut->isPublic()) {
        echo 'public';
    } elseif ($attribut->isPromoted()) {
        echo 'protégé';
    } else {
        echo 'privé';
    }

    if ($attribut->isStatic()) {
        echo ' (attribut statique)';
    }
}


// Les attributs statiques
class A {
    public static $attr = 'Hello world !';
}

$classA = new ReflectionClass('A');
echo $classA->getProperty('attr')->getValue();

// On peut aussi écrire :
class B {
    public static $attr = 'Hello world !';
}

$classB = new ReflectionClass('B');
echo $classB->getStaticPropertyValue('attr'); // Affiche Hello world !

$classB->setStaticPropertyValue('attr', 'Bonjour le monde !');
echo $classB->getStaticPropertyValue('attr'); // Affiche Bonjour le monde !

// Obtenir tous les attributs statiques
class C {
    public static $attr1 = 'Hello world !';
    public static $attr2 = 'Bonjour le monde !';
    private $_attr3 = 'Je suis privé';
    protected $attr4 = 'Je suis protégé';
}

$classC = new ReflectionClass('C');
foreach ($classC->getStaticProperties() as $attr) {
    echo $attr;
}
// À l'écran s'affichera Hello world ! Bonjour le monde !
