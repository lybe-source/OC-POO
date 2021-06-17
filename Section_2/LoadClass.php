<?php

function LoadClass($class) {
    require $class . '.php'; // On inclut la classe correspondante au paramètre passé.
}
