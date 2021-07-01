<?php

class Observer1 implements SplObserver {

    public function update(SplSubject $subject)
    {
        echo "Observer1 a été notifié ! Nouvelle valeur de l'attribut <strong>nom</strong> : ". $subject->getName();
    }

}


class Observer2 implements SplObserver {

    public function update(SplSubject $subject)
    {
        echo "Observer2 a été notifié ! Nouvelle valeur de l'attribut <strong>nom</strong> : " . $subject->getName();
    }

}