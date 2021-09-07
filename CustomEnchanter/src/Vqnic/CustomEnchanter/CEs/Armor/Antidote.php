<?php

namespace Vqnic\CustomEnchanter\CEs\Armor;

use pocketmine\Player;

use Vqnic\CustomEnchanter\Main;

class Antidote extends ArmorCE{

    private int $CElevel;
    private Player $attacker;
    private Player $victim;

    function __construct($l, $a, $v)
    {
        $this->CElevel = $l;
        $this->attacker = $a;
        $this->victim = $v;
    }

    public function trigger()
    {
        if (mt_rand(1, 100) <= 2) { // 2% chance

        }
    }
}
