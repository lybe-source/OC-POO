<?php

function LoadClass($class) {
    if ($class !== 'PDOFactory') {
        require 'PatternObserver/' . $class . '.php'; // On inclut la classe correspondante au paramètre passé.
    } else {
        require 'PatternFactory.php';
    }
}
