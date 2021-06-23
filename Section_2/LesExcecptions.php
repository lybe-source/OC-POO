<?php

class LesExcecptions {

    public function additionner($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            // On lance une nouvelle exception grâce à throw et on instancie directement un objet de la classe Exception
            throw new MonException('Les deux paramètres doivent être des nombres'); // On lance une exception "MonException"
        }

        if (func_num_args() > 2) {
            throw new Exception('Pas plus de deux arguments ne doivent être passés à la fonction'); // Cette fois-ci, on lance une exception "Exception"
        }

        return $a + $b;
    }

    

}