<?php

namespace Vqnic\CustomEnchanter\CEs\Tools;


use Vqnic\CustomEnchanter\CEs\Tools\ToolCE;
use Vqnic\CustomEnchanter\Main;
use pocketmine\Player;
use pocketmine\block\Block;

class Crystalline extends ToolCE{

    private int $CElevel;
    private Player $player;
    private Block $block;

    function __construct($l, $b, $p){
        $this->CElevel = $l;
        $this->player = $p;
        $this->block = $b;
    }

    public function trigger(){
        if(mt_rand(1, 100) <= 2){ // 2% chance
            //do a thing
            switch($this->CElevel){
                case 1:
                    break;

                case 2:

                    break;

                case 3:

                    break;

                case 4:

                    break;
            }
        }
    }
}
