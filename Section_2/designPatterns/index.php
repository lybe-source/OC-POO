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


// Les classes anonymes
// Une classe anonyme est une classe ne possédant pas de nom. Vous serez amenés à en utiliser lorsque la classe que vous écrivez n'est clairement destinée qu'à une seule utilisation précise ou qu'elle n'a pas besoin d'être documentée. Dans ces cas-là, il n'est pas utile de déclarer cette classe dans un fichier dédié (ça en vient même à alourdir inutilement le code)
$mailSender = new class('login@fai.tld') implements SplObserver
{
  protected $mail;
  
  public function __construct($mail)
  {
    if (preg_match('`^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$`', $mail))
    {
      $this->mail = $mail;
    }
  }
  
  public function update(SplSubject $obj)
  {
    mail($this->mail, 'Erreur détectée !', 'Une erreur a été détectée sur le site. Voici les informations de celle-ci : ' . "\n" . $obj->getFormatedError());
  }
};

$db = PDOFactory::getMysqlConnexion();
$dbWriter = new class($db) implements SplObserver
{
  protected $db;
  
  public function __construct(PDO $db)
  {
    $this->db = $db;
  }
  
  public function update(SplSubject $obj)
  {
    $q = $this->db->prepare('INSERT INTO erreurs SET erreur = :erreur');
    $q->bindValue(':erreur', $obj->getFormatedError());
    $q->execute();
  }
};

$o = new ErrorHandler; // Nous créons un nouveau gestionnaire d'erreur.

$o->attach($mailSender)
  ->attach($dbWriter);

set_error_handler([$o, 'error']); // Ce sera par la méthode error() de la classe ErrorHandler que les erreurs doivent être traitées.

5 / 0; // Générons une erreur