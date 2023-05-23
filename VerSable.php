<?php

require_once('./classes/Ennemi.php');

class VerSable extends Ennemi
{
    public function __construct()
    {
        $this->pol = 1;
        $this->name = "Ver de Sable";
        $this->power = 15;
        $this->constitution = 15;
        $this->speed = 5;
        $this->xp = 20;
        $this->cristal = 100;
        $image = "http://media.wizards.com/2017/images/daily/c4rd4r7_WegnP0IDd2.jpg";

        print '<img src="'.$image.'" alt="tigre" />';
    }

    public function fear()
    {

    }
}