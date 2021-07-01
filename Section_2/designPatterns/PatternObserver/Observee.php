<?php

// Le problème
// Dans votre script est présente une classe qui s'occupe de la gestion d'un module. Lors d'une action précise, vous exécutez une ou plusieurs instructions. Celles-ci n'ont qu'une seule chose en commun : le fait qu'elles soient appelées car telle action s'est produite. Elles ont été placées dans la méthode « parce qu'il faut bien les appeler et qu'on sait pas où les mettre ». Il est intéressant dans ce cas-là de séparer les différentes actions effectuées lorsque telle action survient. Pour cela, nous allons regarder du côté du pattern Observer.

// Le principe est simple : vous avez un objet observé et un ou plusieurs autre(s) objet(s) qui l'observe(nt). Lorsque telle action survient, vous allez prévenir tous les objets qui l'observent. Nous allons, pour une raison d'homogénéité, utiliser les interfaces prédéfinies de la SPL. Il s'agit d'une librairie standard qui est fournie d'office avec PHP. Elle contient différentes classes, fonctions, interfaces, etc. Vous vous en êtes déjà servi en utilisant spl_autoload_register() par exemple.

// Attardons-nous plutôt sur ce qui nous intéresse, à savoir deux interfaces : SplSubject et SplObserver.

// La première interface, SplSubject, est l'interface implémentée par la classe dont l'objet observé est issu. Elle contient trois méthodes :

    // attach(SplObserver $observer) : méthode appelée pour ajouter un objet observateur à notre objet observé.

    // detach(SplObserver $observer) : méthode appelée pour supprimer un objet observateur.

    // notify() : méthode appelée lorsque l'on aura besoin de prévenir tous les objets  observateurs que quelque chose s'est produit.


// L'interface SplObserver est l'interface implémentée par les différents observateurs. Elle ne contient qu'une seule méthode qui est celle appelée par l'objet observé dans la méthode notify() : il s'agit de update(SplSubject $subject).


class Observee implements SplSubject {

    // Ceci est le tableau qui va contenir tous les objets qui nous observent
    protected $observers = [];

    // Dès que cet attribut changera on notifiera les classes observatrices
    protected $name;

    public function attach(SplObserver $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(SplObserver $observer)
    {
        if (is_int($key = array_search($observer, $this->observers, true))) {
            unset($this->observers[$key]);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        $this->notify();
    }

}