
<div> <?php
 

require_once('./classes/Ennemi.php');

class Tiger extends Ennemi
{
    public function __construct()
    {
        $this->pol = 3;
        $this->name = "Tigre des Sables";
        $this->power = 10;
        $this->constitution = 8;
        $this->speed = 7;
        $this->xp = 4;
        $this->cristal = 10;
        $image = "https://cdna.artstation.com/p/assets/images/images/027/881/302/large/nutchapol-thitinunthakorn-deserttiger.jpg?1592844042";

        print '<img src="'.$image.'" alt="tigre" />';
    
        
    }

    public function runaway()
    {

    }
}
