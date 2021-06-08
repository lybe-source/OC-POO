<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP : Mini jeu de combat</title>
</head>
<body>
<?php 
    include('autoload.php');

    if (isset($message)) {
        echo '<p>', $message , '</p>';
    }
?>



<form action="" method="POST">
    <p>
        Nom : <input type="text" name="nom" maxlength="50">
        <input type="submit" value="Créer ce personnage" name="creer">
        <input type="submit" value="Utiliser ce personnage" name="utiliser">
    </p>
</form>
    
</body>
</html>