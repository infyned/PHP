<?php 

declare (strict_types=1);

namespace Player;

class Player {
    public function __construct (
        private string $name,
        private string $city = ""
    ) {
        $this->name = $name;
    }

    public function setCity (?string $city) : Player 
    {
        $this->city = $city;
        return $this;
    }

    public function getCity () : ?string
    {
        return $this->city;
    }

    public function getName () : string 
    {
        return $this->name;
    }
}
?>