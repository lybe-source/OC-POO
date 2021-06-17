<?php

require('LoadClass.php');
spl_autoload_register('LoadClass'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

echo "Ceci est la section 2<br />";

$a = new MaClass;
$b = $a; // On assigne à $b l'identifiant de $a, donc $a et $b représentent le même objet

$a->attribut1 = 'Hello';
echo $b->attribut1; // Affiche Hello

$b->attribut2 = 'Salut';
echo $a->attribut2; // Affiche Salut

?>
<br />
<?php

$c = new MaClass;
$d = clone $c;

echo "Nombre d'instances de MaClass : ", MaClass::getInstances(), '<br />'; // Cela affichera Nombre d'instances de MaClass : 3

if ($c == $d) {
    echo '$c et $d sont identiques !<br />';
} else {
    echo '$c et $d sont différents !<br />';
}

$classe = new Liste;
$enfant = new EnfantListe;

echo '---- Liste les attributs depuis l\'intérieur de la classe principale ----<br />';
$classe->listeAttributs();

echo '---- Liste les attributs depuis l\'intérieur de la classe enfant ----<br />';
$enfant->listeAttributs();

echo '<br />---- Liste les attributs depuis le script global ----<br />';

foreach ($classe as $attribut => $valeur) {
    echo '<strong>', $attribut, '</strong> => ', $valeur, '<br />';
}
