<?php

class MethodeMagique {

    private $attributs = [];
    private $unAttributPrive;
    protected $text, $string1, $string2;

    public function __construct($text = null, $string1 = null, $string2 = null)
    {
        $this->text = $text;
        $this->string1 = $string1;
        $this->string2 = $string2;
    }

    /**
     * Cette méthode est appelée pour lire des données depuis des propriétés inaccessibles (protégées ou privées) ou non existante.
     */
    public function __get($name)
    {
        if (isset($this->attributs[$name])) {
            return $this->attributs[$name];
        }
    }

    /**
     * Cette méthode est sollicitée lors de l'écriture de données vers des propriétés inaccessibles (protégées ou privées) ou non existante.
     */
    public function __set($name, $value)
    {
        $this->attributs[$name] = $value;
    }

    /**
     * Cette méthode est sollicitée lorsque isset() ou empty() sont appelées sur des propriétés inaccessibles (protégées ou privées) ou non existante.
     */
    public function __isset($name)
    {
        return isset($this->attributs[$name]);
    }

    /**
     * Cette méthode est invoquée lorsque unset() est appelée sur des propriétés inaccessibles (protégées ou privées) ou non existante.
     */
    public function __unset($name)
    {
        if (isset($this->attributs[$name])) {
            unset($this->attributs[$name]);
        }
    }

    /**
     * Cette méthode est appelée lorsque l'on invoque des méthodes inaccessibles dans un contexte objet.
     */
    public function __call($name, $arguments)
    {
        echo "La méthode <strong>", $name, "</strong> a été appelée alors qu'elle n'existe pas ! Ses arguments étaient les suivants : <strong>". implode('</strong>, <strong>', $arguments). "</strong><br />";
    }

    /**
     * Cette méthode est lancée lorsque l'on invoque des méthodes inaccessibles dans un contexte statique.
     */
    public static function __callStatic($name, $arguments)
    {
        echo "La méthode <strong>", $name, "</strong> a été appelée dans un contexte statique alors qu'elle n'existe pas ! Ses arguments étaient les suivants : <strong>", implode('</strong>, <strong>', $arguments), "</strong><br />";
    }

    /**
     * Cette méthode détermine comment l'objet doit réagir lorsqu'il est traité comme une chaîne de caractères. Par exemple, ce que echo $obj; affichera.
     */
    public function __toString()
    {
        return $this->text;
    }

    /**
     * Cette méthode statique est appelée pour les classes exportées par la fonction var_export().
     * Le seul paramètre de cette méthode est un tableau contenant les propriétés exportées sous la forme ['property' => value, ...].
     */
    public static function __set_state($properties)
    {
        $obj = new MethodeMagique($properties['string1'], $properties['string2']); // On crée un objet avec les attributs de l'objet que l'on veut exporter.
        return $obj; // On retourne l'objet créé
    }

    /**
     * Cette méthode est appelée lorsqu'un script tente d'appeler un objet comme une fonction.
     */
    public function __invoke($argument)
    {
        echo $argument;
    }

    public function afficherAttributs() {
        echo '<pre>', print_r($this->attributs, true), '</pre>';
    }

}