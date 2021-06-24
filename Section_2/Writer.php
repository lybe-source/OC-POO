<?php

class Writer {

    use HTMLFormater;

    // Résoudre les conflits éventuels entre traits
    /**
     * use HTMLFormater, TextFormater {
     *      HTMLFormater::format insteadof TextFormater;
     * }
    */
    public function write($text) {
        file_put_contents('fichier.txt', $this->format($text));
    }

}