<?php

/**
 * @Table("personnages")
 * @Type( {'brute', 'guerrier', 'magicien'} )
 * @TypeBetter( {meilleur = 'magicien', 'moins bon' = 'brute', neutre = 'guerrier} )
 * @uneAnnotation( {uneCle = 1337, {uneCle2 = true, uneCle3 = 'une valeur'} } )
 * @ClassInfos(author = 'Lybe_', version = '1.0')
 */
// Notez la mise entre quotes de moins bon dans TypeBetter : elles sont utiles ici car un espace est présent. Cependant, comme vous le voyez avec meilleur et neutre, elles ne sont pas obligatoires.
class Personnage {

    /**
     * @AttrInfos(description = 'Contient la force du personnage, de 0 à 100', type = 'int')
     */
    protected $force;

    /**
     * @ParamInfo(name = 'destination', description = 'La destination du personnage')
     * @ParamInfo(name = 'vitesse', description = 'La vitesse à laquelle se déplace le personnage)
     * @MethodInfos(description = 'Déplace le personnage à un autre endroit', return = true, returnDescription = 'Retourne true si le personnage peut se déplacer')
     */
    public function deplacer($destination, $vitesse) {}

}