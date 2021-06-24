<?php

trait HTMLFormater {

    public function format($text) {
        return '<p>Date : ' . date('d/m/Y') . '</p>' . "\n" . '<p>' . nl2br($text) . '</p>';
    }

}