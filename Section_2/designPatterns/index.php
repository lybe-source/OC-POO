<?php
echo "Design patterns<br />";

$o = new Observee;
$o->attach(new Observer1); // Ajout d'un observateur
$o->attach(new Observer2); // Ajout d'un autre observateur
$o->setName('Victor'); // On modifie le nom pour voir si les classes observatrices ont bien été notifiée



$o2 = new ErrorHandler; // Nous créons un nouveau gestionnaire d'erreur
$db = PDOFactory::getMysqlConnexion();

$o2->attach(new MailSender('login@fai.tld'))
    ->attach(new BDDWriter($db));

set_error_handler([$o2, 'error']); // Ce sera par la méthode error() de la classe ErrorHandler que les erreurs doivent être traitées

5 / 0; // Générons une erreur