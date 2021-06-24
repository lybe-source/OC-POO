<?php

abstract class MaClassTrait {

    use tA {
        //saySomething as protected;
        saySomething as sayWhoYouAre;
        //saySomething as protected sayWhoYouAre;
    }

}