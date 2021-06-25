<?php
include('autoload.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TP : Mini jeu de combat - Version 2</title>
    
    <meta charset="utf-8" />
  </head>
  <body>

    <?php include('reflexivite.php'); ?>

    <p>Nombre de personnages créés : <?= $manager->count() ?></p>
<?php
if (isset($message)) // On a un message à afficher ?
{
  echo '<p>', $message, '</p>'; // Si oui, on l'affiche
}

if (isset($perso)) // Si on utilise un personnage (nouveau ou pas).
{
?>
    <p><a href="?deconnexion=1">Déconnexion</a></p>
    
    <fieldset>
      <legend>Mes informations</legend>
      <p>
        Type : <?= ucfirst($perso->type()) ?><br />
        Nom : <?= htmlspecialchars($perso->nom()) ?><br />
        Dégâts : <?= $perso->degats() ?><br />
<?php
// On affiche l'atout du personnage suivant son type.
switch ($perso->type())
{
  case 'magicien' :
    echo 'Magie : ';
    break;
  
  case 'guerrier' :
    echo 'Protection : ';
    break;
}

echo $perso->atout();
?>
      </p>
    </fieldset>
    
    <fieldset>
      <legend>Qui attaquer ?</legend>
      <p>
<?php
// On récupère tous les personnages par ordre alphabétique, dont le nom est différent de celui de notre personnage (on va pas se frapper nous-même :p).
$retourPersos = $manager->getList($perso->nom());

if (empty($retourPersos))
{
  echo 'Personne à frapper !';
}

else
{
  if ($perso->estEndormi())
  {
    echo 'Un magicien vous a endormi ! Vous allez vous réveiller dans ', $perso->reveil(), '.';
  }
  
  else
  {
    foreach ($retourPersos as $unPerso)
    {
      echo '<a href="?frapper=', $unPerso->id(), '">', htmlspecialchars($unPerso->nom()), '</a> (dégâts : ', $unPerso->degats(), ' | type : ', $unPerso->type(), ')';
      
      // On ajoute un lien pour lancer un sort si le personnage est un magicien.
      if ($perso->type() == 'magicien')
      {
        echo ' | <a href="?ensorceler=', $unPerso->id(), '">Lancer un sort</a>';
      }
      
      echo '<br />';
    }
  }
}
?>
      </p>
    </fieldset>
<?php
}
else
{
?>
    <form action="" method="post">
      <p>
        Nom : <input type="text" name="nom" maxlength="50" /> <input type="submit" value="Utiliser ce personnage" name="utiliser" /><br />
        Type :
        <select name="type">
          <option value="magicien">Magicien</option>
          <option value="guerrier">Guerrier</option>
        </select>
        <input type="submit" value="Créer ce personnage" name="creer" />
      </p>
    </form>
<?php
}
?>
  </body>
</html>
<?php
if (isset($perso)) // Si on a créé un personnage, on le stocke dans une variable session afin d'économiser une requête SQL.
{
  $_SESSION['perso'] = $perso;
}