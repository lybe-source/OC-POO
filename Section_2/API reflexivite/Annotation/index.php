<?php

require 'addendum/annotations.php';
require 'MyAnnotations.php';
require 'Personnage.php';

// Instanciation de la classe ReflectionAnnotatedClass se trouvant dans addendum/annotations.php
$reflectedClass = new ReflectionAnnotatedClass('Personnage');

// Récupération de l'annotation Table de la classe Personnage
// Notice: Trying to get property 'value' of non-object 
echo 'La valeur de l\'annotation <strong>Table</strong> est <strong>' . $reflectedClass->getAnnotation('Table')->value . '</strong>';

// Récupération de l'annotation Type de la classe Personnage
// Notice: Trying to get property 'value' of non-object 
print_r($reflectedClass->getAnnotation('Type')->value); // Affiche le détail du tableau

// Savoir si une classe possède telle annotation
$ann = 'Table';
if ($reflectedClass->hasAnnotation($ann)) {
    echo 'La classe possède une annotation <strong>' . $ann . '</strong> dont la valeur est <strong>' . $reflectedClass->getAnnotation($ann)->value . '</strong>';
}

// Pour accéder aux valeurs des attributs de la classe ClassInfos
$classInfos = $reflectedClass->getAnnotation('ClassInfos');
// Notice: Trying to get property 'author' of non-object
echo $classInfos->author;
// Notice: Trying to get property 'version' of non-object 
echo $classInfos->version;

// Pour récupérer une de ces annotations, il faut d'abord récupérer l'attribut ou la méthode. Nous allons pour cela se tourner vers ReflectionAnnotatedProperty et ReflectionAnnotatedMethod. Le constructeur de ces classes attend en premier paramètre le nom de la classe contenant l'élément et, en second, le nom de l'attribut ou de la méthode. Exemple :
$reflectedAttr = new ReflectionAnnotatedProperty('Personnage', 'force');
$reflectedMethod = new ReflectionAnnotatedMethod('Personnage', 'deplacer');

echo 'Infos concernant l\'attribut : ';
var_dump($reflectedAttr->getAnnotation('AttrInfos'));

// Notez ici l'utilisation de ReflectionAnnotatedMethod::getAllAnnotations(). Cette méthode permet de récupérer toutes les annotations d'une entité correspondant au nom donné en argument. Si aucun nom n'est donné, alors toutes les annotations de l'entité seront retournées.
echo 'Infos concernant les paramètres de la méthode :';
var_dump($reflectedMethod->getAllAnnotations('ParamInfo'));

echo 'Infos concernant la méthode :';
var_dump($reflectedMethod->getAnnotation('MethodInfos'));
