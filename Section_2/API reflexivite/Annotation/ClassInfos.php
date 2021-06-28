<?php

// Contraindre une annotation à une cible précise
// Grâce à une annotation un peu spéciale, vous avez la possibilité d'imposer un type de cible pour une annotation. En effet, jusqu'à maintenant, nos annotations pouvaient être utilisées aussi bien par des classes que par des attributs ou des méthodes. Dans le cas des annotations ClassInfos, AttrInfos, MethodInfos et ParamInfos, cela présenterait un non-sens qu'elles puissent être utilisées par n'importe quel type d'élément.
// Pour pallier ce problème, retournons à notre classe ClassInfos. Pour dire à cette annotation qu'elle ne peut être utilisée que sur des classes, il faut utiliser l'annotation spéciale @Target:

/**
 * @Target("class")
 */
class ClassInfos extends Annotation {
    
    public $author;
    public $version;
    
    // Réécriture de la fonction checkConstraints se trouvant dans la classe Annotation dans le fichier addendum/annotations.php
    // Le fait que les attributs soient publics peut poser quelques problèmes. En effet, de la sorte, nous ne pouvons pas être sûrs que les valeurs assignées soient correctes. Heureusement, la bibliothèque nous permet de pallier ce problème en réécrivant la méthode checkConstraints() (déclarée dans sa classe mère Annotation) dans notre classe représentant l'annotation, appelée à chaque assignation de valeur, dans l'ordre dans lequel sont assignées les valeurs. Vous pouvez ainsi vérifier l'intégrité des données, et lancer une erreur si il y a un problème. Cette méthode prend un argument : la cible d'où provient l'annotation. Dans notre cas, l'annotation vient de notre classe Personnage, donc le paramètre sera une instance de ReflectionAnnotatedClass représentant Personnage.
    public function checkConstraints($target) {
        if (!is_string($this->author)) {
            throw new Exception("L'auteur doit être une chaîne de caractères");
        }

        if (!is_numeric($this->version)) {
            throw new Exception("Le numéro de version doit être un nombre valide");
        }
    }

}