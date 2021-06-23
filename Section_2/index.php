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

echo "<br />---- Partie sur les interfaces ----<br />";

echo iA::MA_CONSTANTE; // Affiche Hello !

echo '<br />';

echo A::MA_CONSTANTE; // Affiche Hello !

echo "<br /><br />---- Iterator ----<br /><br />";

$objet = new MaClass;
echo 'Parcours de l\'objet...<br />';
foreach ($objet as $key => $value) {
    echo $key, ' => ', $value, '<br />';
}


echo "<br />---- SeekableIterator ----<br />";
echo '<br />Remise du curseur en troisième position...<br />';

$objet->seek(2);
echo 'Élément courant : ', $objet->current(), '<br />';
echo '<br />Affichage du troisième élément : ', $objet[2], '<br />';


echo "<br />---- ArrayAccess ----<br />";

echo '<br />Modification du troisième élément...';
$objet[2] = 'Hello world !';
echo 'Nouvelle valeur : ', $objet[2], '<br /><br />';

echo 'Destruction du quatrième élément...<br />';
unset($objet[3]);

if (isset($objet[3])) {
    echo '$objet[3] existe toujours... Bizarre...';
} else {
    echo 'Tout se passe bien, $objet[3] n\'existe plus !';
}

echo "<br /><br />---- Countable ----<br />";
echo '<br />Maintenant, il n\'en comporte plus que ', count($objet), ' !<br />';


echo '<br />---- Les exceptions ----<br />';
$result = new LesExcecptions;

// On va essayer d'effectuer les instructions situées dans ce bloc
try {
    echo $result->additionner(12, 3) . '<br />';
    echo $result->additionner('azerty', 54) . '<br />';
    echo $result->additionner(4, 8) . '<br />';
    echo $result->additionner(15, 54, 45) . '<br />';
} 
// On va attraper les exceptions "Exception" s'il y en a une qui est levée
catch (MonException $e) {
    echo "[Exception] : " . $e . " avec le code d'erreur : " . $e->getCode();
}

// Si l'exception n'est toujours pas attrapée, alors nous allons essayer d'attraper l'exception "Exception"
catch (Exception $e) {
    echo '[Exception] : ' . $e->getMessage(); // La méthode __toString() nous affiche trop d'informations, nous voulons juste le message d'erreur
}

echo "<br />Fin du script<br /><br />"; // Ce message s'affiche, ça prouve bien que le script est exécuté jusqu'au bout

$setErrorHandler = new MonException2();