<?php

class MaClass implements SeekableIterator, ArrayAccess, Countable {

    public $attribut1;
    public $attribut2;

    private $position = 0;
    private $tableau = ['Premier élément', 'Deuxième élément', 'Troisième élément', 'Quatrième élément', 'Cinquième élément'];
    private static $instances = 0;

    public function __construct() {
        self::$instances++;
    }

    public function __clone() {
        self::$instances++;
    }

    public static function getInstances() {
        return self::$instances;
    }

    // Fonction de l'interface Iterator
    /**
     * Retourne l'élément courant du tableau
     */
    public function current() {
        return $this->tableau[$this->position];
    }

    /**
     * Retourne la clé actuelle (c'est la même que la position dans notre cas
     */
    public function key() {
        return $this->position;
    }

    /**
     * Déplace le curseur vers l'élément suivant
     */
    public function next() {
        $this->position++;
    }

    /**
     * Remet la position du curseur à 0
     */
    public function rewind() {
        $this->position = 0;
    }

    /**
     * Permet de tester si la position actuelle est valide
     */
    public function valid() {
        return isset($this->tableau[$this->position]);
    }

    /**
     * Fonction de l'interface SeekableIterator
     * Permet de placer le curseur interne à une position précise
     */
    public function seek($position) {
        $anciennePosition = $this->position;
        $this->position = $position;

        if (!$this->valid()) {
            trigger_error('La position spécifiée n\'est pas valide', E_USER_WARNING);
            $this->position = $anciennePosition;
        }
    }

    // Fonction de l'interface ArrayAccess
    /**
     * Vérifie si la clé existe
     */
    public function offsetExists($key) {
        return isset($this->tableau[$key]);
    }

    /**
     * Retourne la valeur de la clé demandée
     * Une notice sera émise si la clé n'existe pas, comme pour les vrais tableaux
     */
    public function offsetGet($key) {
        return $this->tableau[$key];
    }

    /**
     * Assigne une valeur à une entrée
     */
    public function offsetSet($key, $value) {
        $this->tableau[$key] = $value;
    }

    /**
     * Supprime une entrée et émettra une erreur si elle n'existe pas, comme pour les vrais tableaux
     */
    public function offsetUnset($key) {
        unset($this->tableau[$key]);
    }

    // Fonction de l'interface Countable
    /**
     * Retourne le nombre d'entrée de notre tableau
     */
    public function count() {
        return count($this->tableau);
    }

}