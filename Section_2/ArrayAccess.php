<?php

interface ArrayAccess {

    /**
     * méthode qui vérifiera l'existence de la clé entre crochets lorsque l'objet est passé à la fonction isset ou empty (cette valeur entre crochet est passée à la méthode en paramètre)
     */
    public function offsetExists($key);

    /**
     * méthode appelée lorsqu'on fait un simple $obj['clé']. La valeur 'clé' est donc passée à la méthode offsetGet
     */
    public function offsetGet($key);

    /**
     * méthode appelée lorsqu'on assigne une valeur à une entrée. Cette méthode reçoit donc deux arguments, la valeur de la clé et la valeur qu'on veut lui assigner.
     */
    public function offsetSet($key, $value);

    /**
     * méthode appelée lorsqu'on appelle la fonction unset sur l'objet avec une valeur entre crochets. Cette méthode reçoit un argument, la valeur qui est mise entre les crochets.
     */
    public function offsetUnset($key);

}