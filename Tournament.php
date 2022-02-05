<?php  

declare (strict_types=1);

namespace Tournament;

use Player\Player;

require_once 'Player.php';

class Tournament {
    private array $players = [];

    public function __construct (
        private string $name, 
        private $date = ""
        ) {
        $this->name = $name;
        if ($date !== "") {    
            $this->date = $date;
            } else {$this->date = date("Y.m.d", strtotime("+1 day"));
        }
    }

    public function getDate () : string 
    {
        return $this->date;
    }

    public function getName () : string
    {
        return $this->name;
    }

    public function getPlayers () : array
    {
        return $this->players;
    }

    public function addPlayer (Player $player)  : Tournament
    {
        $this->players[] = $player;
        return $this;
    }

    public function createPairs () : void 
    {   
        if (count($this->players) % 2) {
            $this->addPlayer(new Player("Unknown", ""));
        }

        $participants = $this->players;
        $num_of_players = count($participants);
        $num_of_days = $num_of_players - 1;
        $num_of_games = ($num_of_players -1) / 2;

        for ($x = 0; $x < $num_of_days; $x++) {
            echo nl2br($this->name . ", " . date("d.m.Y", strtotime("+" . ($x + 1) 
                . "day", strtotime(str_replace(".", "", $this->date)))) . "\n");

            for ($i = 0; $i < $num_of_games; $i++) {
                $team1 = $participants[$num_of_games - $i];
                $team2 = $participants[$num_of_games + $i + 1];
                $results[] = $team1;
                $results[] = $team2;
                echo nl2br($results[0]->getName() . ($results[0]->getCity() ? " (" . $results[0]->getCity() . ") " : "") . "  -  " 
                    . $results[1]->getName() . ($results[1]->getCity() ? " (" . $results[1]->getCity() . ") " : "") . "\n");
                $results = null;
            }
            
            echo nl2br("\n");
            $tmp = $participants[1];

            for($i = 1; $i < sizeof($participants) - 1; $i++) {
                $participants[$i] = $participants[$i + 1];   
            }
            
            $participants[sizeof($participants) - 1] = $tmp;
        }   
    }
}
?>