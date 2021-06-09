# Cahier des charges

Je veux que nous ayons le choix de créer un certain type de personnage qui aura certains avantages. Il ne doit pas être possible de créer un personnage « normal » (donc il devra être impossible d'instancier la classe Personnage). Comme précédemment, la classe Personnage aura la liste des colonnes de la table en guise d'attributs.

Je vous donne une liste de personnages différents qui pourront être créés. Chaque personnage a un atout différent sous forme d'entier.

    Un magicien. Il aura une nouvelle fonctionnalité : celle de lancer un sort qui aura pour effet d'endormir un personnage pendant $atout * 6 heures (l'attribut $atout représente la dose de magie du personnage).

    Un guerrier. Lorsqu'un coup lui est porté, il devra avoir la possibilité de parer le coup en fonction de sa protection (son atout).

Ceci n'est qu'une petite liste de départ. Libre à vous de créer d'autres personnages !

Comme vous le voyez, chaque personnage possède un atout. Cet atout devra être augmenté lorsque le personnage est amené à s'en servir (c'est-à-dire lorsque le magicien lance un sort ou que le guerrier subit des dégâts).

## Des nouvelles fonctionnalités pour chaque personnage
Étant donné qu'un magicien peut endormir un personnage, il est nécessaire d'implémenter deux nouvelles fonctionnalités :

    Celle consistant à savoir si un personnage est endormi ou non (nécessaire lorsque ledit personnage voudra en frapper un autre : s'il est endormi, ça ne doit pas être possible).

    Celle consistant à obtenir la date du réveil du personnage sous la forme « XX heures, YY minutes et ZZ secondes », qui s'affichera dans le cadre d'information du personnage s'il est endormi.


### Le magicien
Qui dit nouvelle fonctionnalité dit nouvelle méthode. Votre classe Magicien devra donc implémenter une nouvelle méthode permettant de lancer un sort. Celle-ci devra vérifier plusieurs points :

    La cible à ensorceler n'est pas le magicien qui lance le sort.

    Le magicien possède encore de la magie (l'atout n'est pas à 0).

### Le guerrier
Ce qu'on cherche à faire ici est modifier le comportement du personnage lorsqu'il subit des dégâts. Nous allons donc modifier la méthode qui se charge d'ajouter des dégâts au personnage. Cette méthode procédera de la sorte :

    Elle calculera d'abord la valeur de l'atout.

    Elle augmentera les dégâts en prenant soin de prendre en compte l'atout.

    Elle indiquera si le personnage a été frappé ou tué.

## L'atout du magicien et du guerrier se déterminent de la même façon :

    Si les dégâts sont compris entre 0 et 25, alors l'atout sera de 4.

    Si les dégâts sont compris entre 25 et 50, alors l'atout sera de 3.

    Si les dégâts sont compris entre 50 et 75, alors l'atout sera de 2.

    Si les dégâts sont compris entre 75 et 90, alors l'atout sera de 1.

    Sinon, il sera de 0.


Du côté du guerrier, j'utilise une simple formule :
    la dose de dégâts reçu ne sera pas de 5, mais de 5 - $atout. Du côté du magicien, là aussi j'utilise une simple formule : il endort sa victime pendant($this->atout * 6) * 3600 secondes.
