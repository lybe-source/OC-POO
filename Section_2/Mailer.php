<?php

class Mailer {

    use HTMLFormater;

    public function send($text) {
        mail('login@fai.tld', 'Test avec les traits', $this->format($text));
    }

}